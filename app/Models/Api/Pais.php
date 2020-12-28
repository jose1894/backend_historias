<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;

    protected $table = "pais";

    protected $fillable = [
        'cod_pais',
        'des_pais',
        'status_pais'
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
