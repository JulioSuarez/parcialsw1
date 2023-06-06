<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_dato extends Model
{
    use HasFactory;

    public function sintaxis()
    {
        return $this->belongsTo(sintaxis::class);
    }
}
