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
        'assigned_area_id', // a saját területe
        'active',
    ];

    public static array $roleOptions = [
        'waiter',
        'chef',
        'bartender',
        'manager',
    ];

    public static array $areaOptions = [
        'kitchen',
        'bar',
        'all', // manager mindent lát
    ];

    public static array $rules = [
        'user_id' => 'required|integer|exists:users,id',
        'name' => 'required|string|max:100',
        'role' => 'required|string|in:waiter,chef,bartender,manager',
        'assigned_area_id' => 'nullable|string|in:kitchen,bar,all', // új validáció
        'active' => 'required|boolean',
    ];

    public function assignedArea()
    {
        return $this->belongsTo(Area::class, 'assigned_area_id', 'area_id');
    }

    public function canViewArea($areaId)
    {
        if ($this->role === 'manager' || $this->assigned_area_id === null) {
            return true; // manager vagy mindent lát
        }
        
        return $this->assigned_area_id === $areaId;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}