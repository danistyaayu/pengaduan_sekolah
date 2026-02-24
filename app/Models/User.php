<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'username',
        'nis',
        'password',
        'role',
        'class',
        'major',
        'is_active',
        'must_change_password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'must_change_password' => 'boolean',
    ];

    // Relationship
    public function aspirasi()
    {
        return $this->hasMany(Aspirasi::class);
    }

    public function balasan()
    {
        return $this->hasMany(Balasan::class);
    }

    public function historiStatus()
    {
        return $this->hasMany(HistoriStatus::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Helper methods
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isSiswa()
    {
        return $this->role === 'siswa';
    }

    public function isActive()
    {
        return $this->is_active;
    }

    public function mustChangePassword()
    {
        return $this->must_change_password;
    }
    public function username()
    {
        return 'username';
    }
}