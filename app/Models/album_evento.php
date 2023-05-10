<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class album_evento extends Model
{
    use HasFactory;

    protected $table = 'album_eventos';

    protected $fillable = [
        'nombre_album',
        'descripcion',
        'portada',
        'aprobado',
        'id_evento',
    ];

    public function fotos()
    {
        return $this->hasMany(foto::class);
    }

    public function evento()
    {
        return $this->belongsTo(evento::class);
    }

    public function detalle_album_evento()
    {
        return $this->hasMany(detalle_album_evento::class);
    }
}
