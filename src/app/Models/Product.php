<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $primaryKey = 'product_id';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'category',
        'price',
        'status',
        'photo_url',
        'is_featured',
        'allergen_tags',
        'area',
        //'stock_qty', - ha bővítjük
    ];

    public static $rules = [
        'name' => 'required|string|max:100|unique:product',
        'category' => 'required|string|max:50',
        'price' => 'required|numeric|min:0',
        'status' => 'required|in:available,unavailable,archived',
        'photo_url' => 'nullable|url|max:255',
        'is_featured' => 'boolean',
        'allergen_tags' => 'nullable|string|max:100',
        'area' => 'nullable|string|max:50',
        //'stock_qty' => 'required|integer|min:0',
    ];


}
