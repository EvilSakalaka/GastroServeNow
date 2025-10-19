<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestSession extends Model
{
    use HasFactory;

    protected $table = 'guest_session';
    protected $primaryKey = 'session_id';
    public $timestamps = false;

    protected $fillable = [
        'table_number',
        'session_token',
        'started_at',
        'ended_at',
        'active',
    ];

    public static $rules = [
        'table_number' => 'required|integer|exists:table_location,table_number',
        'session_token' => 'required|string|unique:guest_session',
        'started_at' => 'required|date',
        'ended_at' => 'nullable|date|after_or_equal:started_at',
        'active' => 'boolean',
    ];

    public function tableLocation()
    {
        return $this->belongsTo(TableLocation::class, 'table_number', 'table_number');
    }

    public function guests()
    {
        return $this->hasMany(Guest::class, 'guest_session_id', 'session_id');
    }
}