<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incidencias extends Model
{
    //
    protected $table='incidencias';
    protected $fillable = [
        'fecha', 'clase', 'equipo','descripcion','hora','comentario','estado','email','otro','archivo','User_id'
    ];
    public function profesor()
    {
        return $this->belongsTo(User::class);
    }
}
