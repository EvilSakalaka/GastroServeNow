<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'review';

    protected $primaryKey = 'review_id';

    public $timestamps = false;

    protected $fillable = [
        'guest_id',
        'order_id',
        'rating',
        'comment',
        'created_at',
    ];

    public static $rules = [
        'rating' => 'required|integer|min:0|max:5',
        'comment' => 'nullable|string',
    ];

    protected $dates = ['created_at']; 

    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guest_id', 'guest_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
