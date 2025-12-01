<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class MenuController extends Controller
{
    /**
     * Publikus étlap (vendégek számára elérhető)
     */
    public function index(): View
    {
        // Csak elérhető termékek (status = 'available')
        $products = Product::where('status', 'available')
            ->orderBy('category')
            ->orderBy('name')
            ->get();

        // Kategóriák szétválasztása (ha area_id-val dolgozol)
        $food = Product::where('status', 'available')
            ->where('area_id', 1) // Ételek
            ->orderBy('name')
            ->get();

        $drinks = Product::where('status', 'available')
            ->where('area_id', 2) // Italok
            ->orderBy('name')
            ->get();

        return view('menu.index', compact('products', 'food', 'drinks'));
    }
}