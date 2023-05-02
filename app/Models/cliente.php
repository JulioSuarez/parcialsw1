<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'id',
    //     'nombre',
    //     'apellido',
    //     'fecha_nacimiento',
    //     'genero',
    //     'foto_perfil',
    //     'foto_portada',
    //     'user_id',
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function planes()
    {
        return $this->hasMany(planes::class);
    }
}
