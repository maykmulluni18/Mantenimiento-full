<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambientes extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_ambiente'
    ];

    public function post(){
       // return $this->hasMany('App\Models\FacultadOficina');

        return $this->hasMany(FacultadOficina::class,'ambientes_id');

    }
}
