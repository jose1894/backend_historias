<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'estado';

    protected $fillable = ['cod_edo','des_edo','abrv_edo', 'pais_edo', 'status_edo'];

    protected $hidden = ['created_at','updated_at'];

    public function pais() {
        return $this->belongsTo(Pais::class, 'pais_edo', 'id_pais');
    }

    public function municipios() {
        return $this->hasMany(Municipio::class, 'edo_mun', 'id_edo');
    }
}
