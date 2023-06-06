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

    public function sintaxis(){
        return $this->hasMany(sintaxis::class);
    }
}
