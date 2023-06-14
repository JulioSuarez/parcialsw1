<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class atributo extends Model
{
    use HasFactory;

    public function clase()
    {
        return $this->belongsTo(clase::class);
    }

    public function tipo_dato()
    {
        return $this->hasMany(tipo_dato::class);
    }
}
