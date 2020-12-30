<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $table = 'municipio';

    protected $fillable = ['cod_mun', 'des_mun', 'pais_mun', 'edo_mun', 'status_mun'];

    protected $hidden = ['created_at', 'updated_at'];

    public function estado() {
        return $this->belongsTo(Estado::class, 'edo_mun', 'id_edo');
    }

    public function parroquias() {
        return $this->hasMany(Parroquia::class, 'mun_parr', 'id_mun');
    }
}
