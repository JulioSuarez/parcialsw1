<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class planes extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'id',
    //     'nombre',
    //     'descripcion',
    //     'precio',
    //     'foto',
    // ];

    public function cliente()
    {
        return $this->belongsTo(cliente::class);
    }

    public function suscripcion()
    {
        return $this->belongsTo(suscripcion::class);
    }

    public function evento()
    {
        return $this->belongsTo(evento::class);
    }

    public function organizadores()
    {
        return $this->belongsTo(organizadores::class);
    }
}
