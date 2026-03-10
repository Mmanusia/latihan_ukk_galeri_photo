<?php

namespace App\Models;

use App\Models\Album;
use App\Models\Foto;
use App\Models\KomentarFoto;
use App\Models\LikeFoto;
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
        'username',
        'namalengkap',
        'alamat',
        'role',
        'email',
        'password',
    ];

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

    public function albums()
    {
        return $this->hasMany(Album::class, 'UserID');
    }

    public function fotos()
    {
        return $this->hasMany(Foto::class, 'UserID');
    }

    public function komentarfotos()
    {
        return $this->hasMany(KomentarFoto::class, 'UserID');
    }

    public function likefotos()
    {
        return $this->hasMany(LikeFoto::class, 'UserID');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
