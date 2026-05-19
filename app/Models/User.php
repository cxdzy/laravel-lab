<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone_number',
        'address',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin(): bool
    {
        return ($this->role ?? 'student') === 'admin';
    }

    public function isStudent(): bool
    {
        return ($this->role ?? 'student') === 'student';
    }

    public function isLecturer(): bool
    {
        return ($this->role ?? 'student') === 'lecturer';
    }
}