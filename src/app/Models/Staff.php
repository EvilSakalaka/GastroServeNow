<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';  

    protected $primaryKey = 'staff_id';  

    public $timestamps = false;  

    protected $fillable = [
        'user_id',
        'name',
        'role',
        'active',
    ];

    public static array $roleOptions = [
        'waiter',
        'chef',
        'bartender',
        'manager',
    ];

    public static array $rules = [
        'user_id' => 'required|integer|exists:users,id',
        'name' => 'required|string|max:100',
        'role' => 'required|string|in:waiter,chef,bartender,manager',
        'active' => 'required|boolean',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}