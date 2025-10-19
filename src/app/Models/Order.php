<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $primaryKey = 'order_id';
    public $timestamps = false;

    protected $fillable = [
        'guest_session_id',
        'status',
        'timestamp_ordered',
        'timestamp_closed',
        'payment_method',
        'tip_percent',
        'total_amount',
    ];

    public static array $statusOptions = [
        'new',              // új rendelés
        'preparing',        // készül az étel
        'ready',            // kész, vár kiszolgálásra
        'served',           // felszolgálva
        'waiting_payment',  // fizetésre vár
        'paid',             // vendég kész (kifizetett)
        'cancelled',        // törölve (ez nem biztos, hogy kell, de kitudja)
    ];

    public static array $paymentMethodOptions = [
        'cash',
        'card',
    ];

    public static array $tipPercentOptions = [0, 5, 10];

    public static array $rules = [
        'guest_session_id' => 'required|integer|exists:guest_session,session_id',
        'status' => 'required|string|in:new,preparing,ready,served,waiting_payment,paid,cancelled',
        'timestamp_ordered' => 'required|date',
        'timestamp_closed' => 'nullable|date|after_or_equal:timestamp_ordered',
        'payment_method' => 'required|string|in:cash,card',
        'tip_percent' => 'nullable|integer|in:0,5,10',
        'total_amount' => 'required|numeric|min:0',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }
}