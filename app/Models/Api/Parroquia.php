<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parroquia extends Model
{
    use HasFactory;

    protected $table = 'parroquia';

    protected $fillable = ['cod_parr', 'des_parr', 'pais_parr', 'edo_parr', 'mun_parr', 'status_parr'];

    protected $hidden = ['created_at', 'updated_at'];

    public function municipio() {
        return $this->belongsTo(Municipio::class, 'mun_parr', 'id_mun');
    }
}
