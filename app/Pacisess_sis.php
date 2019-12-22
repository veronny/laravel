<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pacisess_sis;


class Pacisess_sis extends Model
{
    protected $table = 'pacisess_sis';
//Query Scope 

    public function scopeCuenta($query, $cuenta)
    {
        if ($cuenta)
            return $query->Where('CUENTA_C', 'LIKE', "%$cuenta%");
    }

    public function scopeNombre($query, $nombre)
    {
        if ($nombre)
            return $query->Where('NOMBRE', 'LIKE', "%$nombre%");
    }

    public function scopeFecha($query, $fecha)
    {
        if ($fecha)
            return $query->Where('FECHA_INGR', 'LIKE', "%$fecha%");
    }
}
