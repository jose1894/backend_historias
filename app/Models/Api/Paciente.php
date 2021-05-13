<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'paciente';

    protected $fillable = [
        'tipo_id',
        'identificacion',
        'nombres',
        'apellidos',
        'email',
        'sexo',
        'fecha_nac'
    ];

    protected $hidden = ['created_at','updated_at'];

    
}
