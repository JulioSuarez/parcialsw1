<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fotos extends Model
{
    use HasFactory;

    protected $table = 'fotos';

    protected $fillable = [
        'nombre_foto',
        'descripcion',
        'fecha',
        'hora',
        'lugar',
        'id_fotoestudio',
    ];

    public function album_foto()
    {
        return $this->hasMany(album_foto::class);
    }

    public function User()
    {
        //metodo para recibir la foreing key
        return $this->belongsTo(User::class);
    }

    public function detalle_album_cliente()
    {
        //metodo para dar la primari key
        return $this->hasMany(detalle_album_cliente::class);
    }

    public function detalle_foto_cliente()
    {
        //metodo para dar la primari key
        return $this->hasMany(detalle_foto_cliente::class);
    }

    public function detalle_foto_evento()
    {
        //metodo para dar la primari key
        return $this->hasMany(detalle_foto_evento::class);
    }
}
