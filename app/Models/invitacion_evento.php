<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invitacion_evento extends Model
{
    use HasFactory;

    protected $table = 'invitacion_eventos';

    public function User()
    {
        //metodo para recibir la foreing key
        return $this->belongsTo(User::class);
    }

    public function Evento()
    {
        //metodo para recibir la foreing key
        return $this->belongsTo(Evento::class);
    }
}
