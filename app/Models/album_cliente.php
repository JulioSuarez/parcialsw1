<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class album_cliente extends Model
{
    use HasFactory;

    protected $table = 'album_cliente';

    protected $fillable = [
        'nombre_album',
        'descripcion',
        'portada',
        'aprobado',
        'id_cliente',
    ];

    public function fotos()
    {
        return $this->hasMany(foto::class);
    }

    public function cliente()
    {
        return $this->belongsTo(User::class);
    }

    public function detalle_album_cliente()
    {
        return $this->hasMany(detalle_album_cliente::class);
    }
}
