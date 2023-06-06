<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clase extends Model
{
    use HasFactory;

    public function atributos()
    {
        // doy la llave foranea de la tabla atributos
        return $this->hasMany(atributo::class);
    }
}
