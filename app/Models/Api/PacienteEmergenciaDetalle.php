<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PacienteEmergenciaDetalle extends Model
{
    use HasFactory;
    protected $table = 'emergencia_detalle';

    protected $fillable = [
        'paciente_emergencia_id',
        'persona_id',
        'motivo_ingreso',
        'impresion_diagnostica',
        'dest',
        'observaciones',
    ];
    protected $hidden = ['created_at','updated_at'];

    public function pacienteEmergenciaDetalle() {
        return $this->belongsTo(PacienteEmergenciaDetalle::class, 'paciente_emergencia_id');
    }

    public function persona() {
        return $this->belongsTo(Persona::class, 'persona_id');
    }

   
}
