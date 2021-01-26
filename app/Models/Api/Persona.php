<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $table = 'persona';

    protected $fillable = [
        'tipo_id', 
        'identificacion', 
        'nombres',
        'apellidos',
        'sexo',
        'email',
        'fecha_nac',
        'direccion',
        'especialidad_id',
        'area_id',
        'tipo_persona_id',
        'talla',
        'peso',
    ];
    protected $hidden = ['created_at','updated_at'];

    public function especialidad() {
        return $this->belongsTo(Especialidad::class, 'especialidad_id');
    }

    public function area() {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function tipo_persona() {
        return $this->belongsTo(TipoPersona::class, 'tipo_persona_id');
    }

    public function pacienteEmergencias() {
        return $this->hasMany(PacienteEmergencia::class, 'persona_id');
    }

    public function pacienteEmergenciaDetalles() {
        return $this->hasMany(PacienteEmergenciaDetalle::class, 'persona_id');
    }
}
