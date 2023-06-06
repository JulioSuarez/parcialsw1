<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sintaxi extends Model
{
    use HasFactory;

    public function atributo()
    {
        return $this->belongsTo(atributo::class);
    }

    public function tipo_datos()
    {
        return $this->hasMany(tipo_dato::class);
    }
}
