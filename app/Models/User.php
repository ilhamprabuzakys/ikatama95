<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeCountUser($query, $role = null)
    {
        if ($role) {
            return $query->where('role', $role)->count();
        }

        return $query->count();
    }

    // Model User

    public function scopeSearch($query, $search)
    {
        $search = strtolower($search);
        return $query->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
    }

    public function scopeGlobalSearch($query, $search)
    {
        $search = strtolower($search);

        return $query->whereRaw("LOWER(name) LIKE '%{$search}%' OR 
                                LOWER(email) LIKE '%{$search}%' OR
                                LOWER(username) LIKE '%{$search}%' OR 
                                LOWER(role) LIKE '%{$search}%'");
    }
}
