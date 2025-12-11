<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'status',
        'assigned_area_id',
    ];

        public static array $rules = [
        'name' => 'required|string|max:100',
        'username' => 'required|string|max:50|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
        'role' => 'nullable|string|in:waiter,chef,bartender,manager',
        'status' => 'required|string|in:active,inactive',
        'assigned_area_id' => 'nullable|integer|exists:areas,area_id',
    ];

        public static array $roleOptions = [
        'waiter' => 'Waiter',
        'chef' => 'Chef',
        'bartender' => 'Bartender',
        'manager' => 'Manager',
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

        public function isActive(): bool
    {
        return $this->status === 'active';
    }

   /*     public function canViewArea($areaId): bool
    {
        // Manager és admin mindent lát
        if (in_array($this->role, ['manager', 'admin'])) {
            return true;
        }

        // Pincér mindent lát (teljes rendelés)
        if ($this->role === 'waiter') {
            return true;
        }

        // Chef és bartender csak a saját területét látja
        if (in_array($this->role, ['chef', 'bartender'])) {
            // Ha nincs hozzárendelt terület, nem lát semmit
            if ($this->assigned_area_id === null) {
                return false;
            }
            // Csak a saját területét látja
            return $this->assigned_area_id === $areaId;
        }

        // Új user (nincs szerepkör vagy ismeretlen szerepkör) semmit se lát
        return false;
    }


    public function canModifyArea($areaId): bool
    {
        // Manager és admin mindent módosíthat
        if (in_array($this->role, ['manager', 'admin'])) {
            return true;
        }


        // Chef és bartender csak a saját területét módosíthatja
        if (in_array($this->role, ['chef', 'bartender'])) {
            if ($this->assigned_area_id === null) {
                return false;
            }
            return $this->assigned_area_id === $areaId;
        }

        return false;
    }

    public function getVisibleAreas()
    {
        // Manager, admin és pincér mindent lát
        if (in_array($this->role, ['manager', 'admin', 'waiter'])) {
            return Area::all();
        }

        // Chef és bartender csak a sajátját
        if (in_array($this->role, ['chef', 'bartender']) && $this->assigned_area_id) {
            return Area::where('area_id', $this->assigned_area_id)->get();
        }

        // Új user semmit
        return collect([]);
    }

    /**
     * Visszaadja azokat a területeket, amiket a user módosíthat
     *
     * @return \Illuminate\Database\Eloquent\Collection|array
     */
    /*public function getModifiableAreas()
    {
        // Manager és admin mindent módosíthat
        if (in_array($this->role, ['manager', 'admin'])) {
            return Area::all();
        }

        // Chef és bartender csak a sajátját
        if (in_array($this->role, ['chef', 'bartender']) && $this->assigned_area_id) {
            return Area::where('area_id', $this->assigned_area_id)->get();
        }

        // Pincér és új user semmit nem módosíthat
        return collect([]);
    }

    public function isManager(): bool
    {
        return $this->role === 'manager';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isWaiter(): bool
    {
        return $this->role === 'waiter';
    }

    public function isChef(): bool
    {
        return $this->role === 'chef';
    }

    public function isBartender(): bool
    {
        return $this->role === 'bartender';
    }

    /**
     * Ellenőrzi, hogy a user rendelkezik-e valamilyen szerepkörrel
     *
     * @return bool
     */
    /*public function hasRole(): bool
    {
        return !empty($this->role);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
