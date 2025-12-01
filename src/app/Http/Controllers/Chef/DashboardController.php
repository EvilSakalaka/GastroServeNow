<?php

namespace App\Http\Controllers\Chef;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;

class DashboardController extends Controller
{
    public function __invoke()
    {
        // csak a bár terület tételei (area_id = 2)
        $pendingItems = OrderItem::query()
            ->with(['product', 'area', 'order'])
            ->where('area_id', 1)
            ->whereIn('status', ['ordered', 'preparing', 'ready'])
            ->orderBy('order_item_id')
            ->get();

        return view('chef.dashboard', [
            'items' => $pendingItems,
        ]);
    }
}
