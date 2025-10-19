<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $table = 'assignment';
    protected $primaryKey = 'assignment_id';
    public $timestamps = false;

    protected $fillable = [
        'table_number',
        'user_id',
        'assigned_at',
        'status',
    ];

    public static array $statusOptions = [
        'new',
        'preparing',
        'ready',
        'served',
        'waiting_payment',
        'paid',
        'cancelled',
    ];

    public static array $rules = [
        'table_number' => 'required|integer|exists:table_location,table_number',
        'user_id' => 'required|integer|exists:users,id',
        'assigned_at' => 'required|date',
        'status' => 'required|string|in:new,preparing,ready,served,waiting_payment,paid,cancelled',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tableLocation()
    {
        return $this->belongsTo(TableLocation::class, 'table_number', 'table_number');
    }
}