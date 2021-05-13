<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    use HasFactory;

    protected $table = 'diagnostico';

    protected $fillable = ['descripcion'];

    protected $hidden = ['created_at', 'updated_at'];

    public function emergencias() {
        return $this->hasMany(EmergenciaDetalle::class, 'diagnostico_id');
    }
}
