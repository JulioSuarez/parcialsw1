<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class diagrama extends Model
{
    use HasFactory;

    public function invitado()
    {
        return $this->hasMany(invitado::class);
    }

    public function clase()
    {
        return $this->hasMany(clase::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
