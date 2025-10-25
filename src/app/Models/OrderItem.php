<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_item';
    protected $primaryKey = 'order_item_id';
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'product_id',
        'area_id',
        'quantity',
        'unit_price',
        'comment',
    ];

    public static $rules = [
        'order_id' => 'required|integer|exists:order,order_id',
        'product_id' => 'required|integer|exists:product,product_id',
        'quantity' => 'required|integer|min:1',
        'unit_price' => 'required|numeric|min:0',
        'comment' => 'nullable|string|max:255',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'area_id');
    }
}