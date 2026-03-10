<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Album extends Model
{
    protected $table = 'album';

    public $timestamps = false;

    protected $fillable = [
        'NamaAlbum',
        'Deskripsi',
        'TanggalDibuat',
        'UserID',
    ];

    protected function casts(): array
    {
        return [
            'TanggalDibuat' => 'date',
        ];
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function fotos()
    {
        return $this->hasMany(Foto::class, 'AlbumID');
    }
}
