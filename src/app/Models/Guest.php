<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $table = 'guest';
    protected $primaryKey = 'guest_id';
    public $timestamps = false;

    protected $fillable = [
        'guest_session_id',
        'created_at',
        //'allergen_filter',
    ];

    
    /*public static array $allergenOptions = [
        'none',
        'gluten',
        'nuts',
        'dairy',
        'shellfish',
        'soy',
        'eggs',
        'fish',
    ];*/

    public static array $rules = [
        'guest_session_id' => 'required|integer|exists:guest_session,session_id',
        'created_at' => 'required|date',
        //'allergen_filter' => 'nullable|string|in:none,gluten,nuts,dairy,shellfish,soy,eggs,fish',
    ];


    public function session()
    {
        return $this->belongsTo(GuestSession::class, 'guest_session_id', 'session_id');
    }
    
       public function allergens()
    {
        return $this->belongsToMany(Allergen::class, 'guest_allergens', 'guest_id', 'allergen_id');
    }
}
