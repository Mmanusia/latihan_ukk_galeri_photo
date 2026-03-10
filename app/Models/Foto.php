<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Foto extends Model
{
    protected $table = 'foto';

    public $timestamps = false;

    protected $fillable = [
        'JudulFoto',
        'DeskripsiFoto',
        'TanggalUnggah',
        'LokasiFile',
        'AlbumID',
        'UserID'
    ];

    protected function casts(): array
    {
        return [
            'TanggalUnggah' => 'date',
        ];
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function album()
    {
        return $this->belongsTo(Album::class, 'AlbumID');
    }

    public function komentars(): HasMany
    {
        return $this->hasMany(KomentarFoto::class, 'FotoID')->latest('TanggalKomentar');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(LikeFoto::class, 'FotoID');
    }
}
