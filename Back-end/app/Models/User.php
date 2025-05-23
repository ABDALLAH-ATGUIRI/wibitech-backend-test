<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserRole;
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
        'username',
        'first_name',
        'last_name',
        'password',
        'role',
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

    /**
     * Determine if the user has admin privileges.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === UserRole::ADMIN;
    }

    /**
     * Determine if the user has client privileges.
     *
     * @return bool
     */
    public function isUser()
    {
        return $this->role === UserRole::USER;
    }

    /**
     * Summary of hasRole
     * @param mixed $role
     * @return bool
     */
    public function hasRole($role): bool
    {
        return $this->role === $role;
    }
}
