<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomentarFoto extends Model
{
    protected $table = 'komentarfoto';

    public $timestamps = false;

    protected $fillable = [
        'FotoID',
        'UserID',
        'IsiKomentar',
        'TanggalKomentar',
    ];

    protected function casts(): array
    {
        return [
            'TanggalKomentar' => 'date',
        ];
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function foto()
    {
        return $this->belongsTo(Foto::class, 'FotoID');
    }
}
