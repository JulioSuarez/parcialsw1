<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invitado extends Model
{
    use HasFactory;


    public function invitados()
    {
        return $this->belongsTo(User::class);
    }

    public function diagrama()
    {
        return $this->belongsTo(diagrama::class);
    }


}
