<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $table = 'area';

    protected $fillable = [
        'descripcion'
    ];
    protected $hidden = ['created_at','updated_at'];

    public function persona() {
        return $this->hasOne(persona::class, 'area_id');
    }
}
