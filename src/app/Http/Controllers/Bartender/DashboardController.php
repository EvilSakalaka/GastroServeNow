<?php

namespace App\Http\Controllers\Bartender;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;

class DashboardController extends Controller
{
    public function __invoke()
    {
        // Lekérdezzük az összes feldolgozandó tételt és betöltjük a kapcsolódó product, area és order modelleket
        $pendingItems = OrderItem::with(['product', 'area', 'order'])
            ->whereIn('status', ['ordered', 'preparing', 'ready'])
            ->where('area_id',2)
            ->orderBy('order_item_id')
            ->get();

        // Csoportosítás order.table_number szerint (ha nincs rendelés vagy nincs table_number, 'Nincs asztal')
        $grouped = $pendingItems->groupBy(function ($item) {
            return $item->order && $item->order->table_number
                ? (string) $item->order->table_number
                : 'Nincs asztal';
        })->sortKeys();

        return view('bartender.dashboard', [
            'groupedItems' => $grouped,
        ]);
    }
}
