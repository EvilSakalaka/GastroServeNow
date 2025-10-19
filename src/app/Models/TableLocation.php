<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableLocation extends Model
{
    use HasFactory;

    protected $table = 'table_location';

    protected $primaryKey = 'table_number';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'table_number',
        'location_description',
        'status',
        'active',
    ];

    public static array $statusOptions = [
        'available',
        'occupied',
        'reserved',
        'out_of_service',
        //'cleaning', - ha bővítjük
    ];

    public static array $rules = [
        'table_number' => 'required|integer|unique:table_location,table_number',
        'location_description' => 'nullable|string|max:255',
        'status' => 'required|string|in:available,occupied,reserved,out_of_service,cleaning',
        'active' => 'required|boolean',
    ];
}