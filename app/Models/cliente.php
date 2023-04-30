<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'prerfil_foto_path',
        'portada_foto_path',
        'telefono',
        'id_usuario',
    ];

    // protected $primaryKey = 'ci';
    // protected $keyType = 'string';
    // public $incrementing = false;
    // protected $table = 'clientes';

    // relacion uno a uno
    public function user()
    {
        // metodo para recibir la llave foranea
        return $this->belongsTo(User::class);
    }
}
