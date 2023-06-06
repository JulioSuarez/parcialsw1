<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class relation extends Model
{
    use HasFactory;

    public function class_a(){
        return $this->belongsTo(clase::class);
    }

    public function class_b(){
        return $this->belongsTo(clase::class);
    }

    public function relation_tipo(){
        return $this->belongsTo(relation_tipo::class);
    }
}
