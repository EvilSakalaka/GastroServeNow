<?php

namespace App\Http\Controllers\Waiter;

use App\Http\Controllers\Controller;
use App\Models\GuestSession;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    /**
     * Megjeleníti a rendelésfelvételi felületet.
     * Átadja az aktív session-t és a termékeket (ételek/italok).
     */
    public function create(GuestSession $guest_session)
    {
        // 1. Ételek lekérdezése (a .with('allergens') betölti a kapcsolatot)
        $food = Product::with('allergens') 
                       ->where('status', 'available')
                       ->where('category', '!=', 'ital')
                       ->orderBy('category')
                       ->orderBy('name')
                       ->get();
                       
        // 2. Italok lekérdezése (a .with('allergens') betölti a kapcsolatot)
        $drinks = Product::with('allergens') 
                         ->where('status', 'available')
                         ->where('category', 'ital')
                         ->orderBy('name')
                         ->get();

        // 3. Adatok átadása a nézetnek
        return view('waiter.orders.create', compact('guest_session', 'food', 'drinks'));
    }

    /**
     * Elmenti az új rendelést az adatbázisba.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validálás (alap)
        $request->validate([
            'guest_session_id' => 'required|exists:guest_session,session_id',
            'cart_json' => 'required|json',
            'total_amount' => 'required|numeric|min:0',
            'tip_percent' => 'nullable|numeric|min:0'
        ]);

        // 2. Kosár adatok dekódolása
        $cart = json_decode($request->input('cart_json'), true);
        if (empty($cart)) {
            return back()->withErrors(['cart' => 'A kosár üres.']);
        }

        // 3. Új 'Order' (Rendelés) létrehozása
        $order = Order::create([
            'guest_session_id' => $request->input('guest_session_id'),
            'status' => 'pending', // 'pending' = függőben, 'completed' = fizetve, stb.
            'timestamp_ordered' => now(),
            'total_amount' => $request->input('total_amount'),
            'tip_percent' => $request->input('tip_percent', 0),
            // 'payment_method' és 'timestamp_closed' később kerül kitöltésre
        ]);

        // 4. 'OrderItem' (Rendelési tételek) létrehozása a kosár alapján
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->order_id, // Vagy 'id', attól függ mi a primary key
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'], // Fontos elmenteni az akkori árat
                'area_id' => $item['area_id'],  // A 'product' táblából jön
                'comment' => $item['comment'] ?? null
            ]);
        }

        // 5. Visszairányítás a dashboardra sikerüzenettel
        return redirect()->route('waiter.orders.success', $order);
    }
    public function showSuccess(Order $order)
    {
        // Betöltjük a kapcsolódó GuestSession-t, hogy hozzáférjünk az asztal számához
        // A 'load()' biztosítja, hogy ne kapjunk 'property on null' hibát.
        $order->load('guestSession'); 
        
        // Visszaadjuk az új "siker" nézetet
        return view('waiter.orders.success', compact('order'));
    }
}
