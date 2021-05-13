<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPersona extends Model
{
    use HasFactory;
    protected $table = 'tipo_persona';

    protected $fillable = [
        'descripcion'
    ];
    protected $hidden = ['created_at','updated_at'];

    public function persona() {
        return $this->hasOne(persona::class, 'tipo_persona_id');
    }
}
