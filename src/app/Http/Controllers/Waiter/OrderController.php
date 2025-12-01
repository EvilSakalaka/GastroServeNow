<?php

namespace App\Http\Controllers\Waiter;

use App\Http\Controllers\Controller;
use App\Models\GuestSession;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Allergen;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    /**
     * Megjeleníti a rendelésfelvételi felületet.
     * Átadja az aktív session-t és a termékeket (ételek/italok) allergiákkal.
     */
    public function create(GuestSession $guest_session)
    {
        // 1. Ételek lekérdezése (a .with('allergens') betölti a kapcsolatot)
        $food = Product::with('allergens')
        // 1. Ételek lekérdezése allergiákkal
        $food = Product::with('allergens') 
                       ->where('status', 'available')
                       ->where('category', '!=', 'ital')
                       ->orderBy('category')
                       ->orderBy('name')
                       ->get();

        // 2. Italok lekérdezése (a .with('allergens') betölti a kapcsolatot)
        $drinks = Product::with('allergens')
                       
        // 2. Italok lekérdezése allergiákkal
        $drinks = Product::with('allergens') 
                         ->where('status', 'available')
                         ->where('category', 'ital')
                         ->orderBy('name')
                         ->get();

        // 3. Az összes allergia (ha szükséges a szűréshez később)
        $allergens = Allergen::all();

        // 4. Adatok átadása a nézetnek
        return view('waiter.orders.create', compact('guest_session', 'food', 'drinks', 'allergens'));
        
    }


    /**
     * Elmenti az új rendelést az adatbázisba.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validálás
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
            'status' => 'new',
            'timestamp_ordered' => now(),
            'total_amount' => $request->input('total_amount'),
            'tip_percent' => $request->input('tip_percent', 0),
        ]);

        // 4. 'OrderItem' (Rendelési tételek) létrehozása a kosár alapján
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->order_id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'], // Fontos elmenteni az akkori árat
                'area_id' => $item['area_id'],  // A 'product' táblából jön
                'comment' => $item['comment'] ?? null,
                'status' => $item['status'] ?? 'ordered', // Alapértelmezett státusz 'ordered'
                'unit_price' => $item['price'],
                'area_id' => $item['area_id'],
                'comment' => $item['comment'] ?? null
            ]);
        }

        // 5. Visszairányítás a success oldalra
        return redirect()->route('waiter.orders.success', $order);
    }


    /**
     * Megjeleníti a rendelés megerősítő oldalt allergiákkal.
     */
    public function showSuccess(Order $order)
    {
        // Betöltjük a kapcsolódó GuestSession-t, hogy hozzáférjünk az asztal számához
        // A 'load()' biztosítja, hogy ne kapjunk 'property on null' hibát.
        $order->load('guestSession');

        // Visszaadjuk az új "siker" nézetet
        // Eager loading - az összes szükséges adat egy lekérdezésben
        $order->load([
            'guestSession',           // Az asztal adatai
            'items.product.allergens' // Az ételek allergiái
        ]); 
        
        // Visszaadjuk a siker nézetet
        return view('waiter.orders.success', compact('order'));
    }

            public function edit(Order $order)
            {
                $order->load('items.product.allergens', 'guestSession');
                
                $food = Product::with('allergens') 
                            ->where('status', 'available')
                            ->where('category', '!=', 'ital')
                            ->orderBy('category')
                            ->orderBy('name')
                            ->get();
                            
                $drinks = Product::with('allergens') 
                                ->where('status', 'available')
                                ->where('category', 'ital')
                                ->orderBy('name')
                                ->get();

                $allergens = Allergen::all();

            return view('waiter.orders.add-item', compact('order', 'food', 'drinks', 'allergens'));
            }

            public function addToExistingOrder(Order $order)
            {
                return $this->edit($order);
            }

/**
 * Elmenti az új itemeket a meglévő rendeléshez
 */
            public function storeAddedItems(Request $request, Order $order): RedirectResponse
            {
                // 1. Validálás
                $request->validate([
                    'cart_json' => 'required|json',
                    'total_additional' => 'required|numeric|min:0'
                ]);

                // 2. Kosár adatok dekódolása
                $cart = json_decode($request->input('cart_json'), true);
                if (empty($cart)) {
                    return back()->withErrors(['cart' => 'A kosár üres.']);
                }

                // 3. OrderItem tételek hozzáadása a meglévő rendeléshez
                foreach ($cart as $item) {
                    OrderItem::create([
                        'order_id' => $order->order_id,
                        'product_id' => $item['id'],
                        'quantity' => $item['quantity'],
                        'unit_price' => $item['price'],
                        'area_id' => $item['area_id'],
                        'comment' => $item['comment'] ?? null
                    ]);
                }

                // 4. Az order összes összegének frissítése
                $totalAdditional = (float) $request->input('total_additional');
                $order->update([
                    'total_amount' => $order->total_amount + $totalAdditional
                ]);

                // 5. Visszairányítás a success oldalra
                return redirect()->route('waiter.orders.success', $order);
            }

            

            
            
                public function showPaymentRequest($order_id)
                {
                    $order = Order::findOrFail($order_id);
                    return view('waiter.orders.payment-request', ['order' => $order]);
                }

            
}
