<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergenciaDetalle extends Model
{
    use HasFactory;

    protected $table = 'emergencia_detalle';

    protected $fillable = [
        'emergencia_id', 
        'paciente_id', 
        'motivoing_id', 
        'diagnostico_id', 
        'observaciones'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function emergencia() {
        return $this->belongsTo(Emergencia::class, 'emergencia_id','id');
    }

    public function paciente() {
        return $this->belongsTo(Persona::class, 'paciente_id', 'id');
    }

    public function procedimientos() {
        return $this->hasMany(EmergDetProc::class, 'emergdetproc_id');
    }
}
