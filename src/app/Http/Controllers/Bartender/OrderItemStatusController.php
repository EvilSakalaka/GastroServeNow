<?php

namespace App\Http\Controllers\Bartender;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemStatusController extends Controller
{
    public function update(Request $request, OrderItem $orderItem)
    {
        // leptetett státusz frissítés vagy konkrét státusz beállítása
        $allowedStatuses = ['ordered', 'preparing', 'ready', 'served', 'cancelled'];

        if ($request->has('status')) {
            $validated = $request->validate([
                'status' => 'required|string|in:' . implode(',', $allowedStatuses),
            ]);

            $orderItem->status = $validated['status'];
        } else {
            //leptetem a státuszt sorrendben
            $current = $orderItem->status;
            $flow = ['ordered', 'preparing', 'ready', 'served'];

            $currentIndex = array_search($current, $flow, true);
            // ha nincs több lépés, vagy ismeretlen státusz, akkor nem változtatunk
            if ($currentIndex === false || $currentIndex === count($flow) - 1) {
            } else {
                $orderItem->status = $flow[$currentIndex + 1];
            }
        }

        $orderItem->save();

        return redirect()
            ->route('bartender.dashboard')
            ->with('status', 'A rendelés státusza frissítve lett.');
    }
}
