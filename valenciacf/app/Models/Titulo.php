<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Titulo extends Model
{
    protected $fillable = ['competicion', 'anio', 'descripcion', 'entrenador'];
}