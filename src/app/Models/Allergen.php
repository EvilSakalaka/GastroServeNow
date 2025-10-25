<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allergen extends Model
{
    protected $table = 'allergens';
    protected $primaryKey = 'allergen_id';
    public $timestamps = false;

    protected $fillable = ['name'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_allergens', 'allergen_id', 'product_id');
    }
}
