<?php

namespace App\Models\Api;

use Faker\Provider\ar_JO\Person;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emergencia extends Model
{
    use HasFactory;

    protected $table = 'emergencia';

    protected $fillable = ['persona_id', 'turno', 'enfermera_id', 'fecha'];

    protected $hidden = ['created_at', 'updated_at'];

    public function medico() {
        return $this->belongsTo(Persona::class, 'persona_id', 'id');
    } 

    public function detalle() {
        return $this->hasMany(EmergenciaDetalle::class, 'emergencia_id', 'id');
    }

    public function enfermero() {
        return $this->belongsTo(Persona::class, 'enfermera_id', 'id');
    }
}
