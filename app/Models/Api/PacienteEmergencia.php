<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PacienteEmergencia extends Model
{
    use HasFactory;
    protected $table = 'emergencia';

    protected $fillable = [
        'persona_id',
        'turno',
        'fecha'
    ];
    protected $hidden = ['created_at','updated_at'];

    public function pacienteEmergenciaDetalles() {
        return $this->hasMany(PacienteEmergenciaDetalle::class, 'paciente_emergencia_id');
    }

    public function persona() {
        return $this->belongsTo(Persona::class, 'persona_id');
    }
}
