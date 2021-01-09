<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;

    /** la clave primaria de la tabla debe ser llamada id por limitacion del framework */

    protected $table = 'pais';

    protected $fillable = ['cod_pais', 'des_pais', 'status_pais'];

    protected $hidden = ['created_at', 'updated_at'];

    public function estados() {
        return $this->hasMany(Estado::class, 'pais_edo');
    }
}
