<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergDetProc extends Model
{
    use HasFactory;

    protected $table = 'emerg_det_proc';

    protected $fillable = ['emerdetproc_id', 'observaciones'];

    protected $hidden = ['created_at', 'updated_at'];

    public function emergenciaDetalle() {
        return $this->belongsTo(EmergenciaDetalle::class, 'id');
    }
}
