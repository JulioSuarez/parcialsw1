<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_dato extends Model
{
    use HasFactory;

    // public function formato()
    // {
    //     return $this->belongsTo(formato::class);
    // }

    public function atributo()
    {
        return $this->belongsTo(atributo::class);
    }
}
