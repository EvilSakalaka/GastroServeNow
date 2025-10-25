<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';
    protected $primaryKey = 'area_id';
    public $timestamps = false;

    protected $fillable = ['name', 'display_name', 'active'];

    public function products()
    {
        return $this->hasMany(Product::class, 'area_id', 'area_id');
    }

    public function staff()
    {
        return $this->hasMany(Staff::class, 'assigned_area_id', 'area_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'area_id', 'area_id');
    }
}
