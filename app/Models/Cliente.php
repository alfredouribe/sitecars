<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\suscripciones;

class Cliente extends Model
{
    use HasFactory;
    public function suscripciones()
    {
        return $this->hasMany(suscripciones::class, 'cliente_id'); // Ajusta 'cliente_id' si tu FK es diferente
    }
}
