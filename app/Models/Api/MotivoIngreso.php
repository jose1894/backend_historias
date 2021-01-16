<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotivoIngreso extends Model
{
    use HasFactory;

    protected $table = 'motivo_ingreso';

    protected $fillable = ['descripcion'];

    protected $hidden = ['created_at', 'updated_at'];

    public function emergencias() {
        return $this->hasMany(EmergenciaDetalle::class,'motivoing_id');
    }
}
