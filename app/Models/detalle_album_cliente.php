<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalle_album_cliente extends Model
{
    use HasFactory;

    protected $table = 'detalle_album_cliente';

    protected $fillable = [
        'id_foto',
        'id_album_cliente',
    ];

    public function foto()
    {
        return $this->belongsTo(foto::class);
    }

    public function album_cliente()
    {
        return $this->belongsTo(album_cliente::class);
    }
}
