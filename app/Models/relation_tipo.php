<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class relation_tipo extends Model
{
    use HasFactory;

    public function relation(){
        return $this->hasMany(relation::class);
    }
}
