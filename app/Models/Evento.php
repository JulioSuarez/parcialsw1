<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos';

    protected $fillable = [
        'nombre_evento',
        'descripcion',
        'fecha',
        'hora',
        'lugar',
        'id_fotoestudio',
    ];

    public function album_evento()
    {
        return $this->hasMany(album_evento::class);
    }

    public function User()
    {
        //metodo para recibir la foreing key
        return $this->belongsTo(User::class);
    }

    public function detalle_evento()
    {
        //metodo para dar la primari key
        return $this->hasMany(detalle_evento::class);
    }

    public function detalle_album_evento()
    {
        //metodo para dar la primari key
        return $this->hasMany(detalle_album_evento::class);
    }

    public function detalle_album_cliente()
    {
        //metodo para dar la primari key
        return $this->hasMany(detalle_album_cliente::class);
    }
}
