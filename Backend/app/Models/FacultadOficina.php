<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ambientes;

class FacultadOficina extends Model
{
    use HasFactory;

    protected $fillable = [
        'cod_facultadOfi',
        'nombre_facultad_oficina',
        'nombre_escuela',
        'ambientes_id'
    ];

    public function ambientes() {
        return $this->belongsTo(Ambientes::class, 'ambientes_id');
    }
}
