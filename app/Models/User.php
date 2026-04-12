<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'username',
        'email',
        'password',
        'role',
        'status',
        'last_login',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class);
    }

    public function pengajuanDisetujui()
    {
        return $this->hasMany(Pengajuan::class, 'disetujui_oleh');
    }

    // Role Helpers
    public function isAdmin()
    {
        return $this->role === 'Admin';
    }

    public function isPetugas()
    {
        return $this->role === 'Petugas';
    }

    public function isUser()
    {
        return $this->role === 'User';
    }
}

