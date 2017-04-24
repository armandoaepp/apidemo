<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * developer: @armandoaepp
 * email: armandoaepp@gmail.com
*/
class Marca extends Model
{
	protected $table = 'marca';
    public $timestamps = false;
	protected $fillable = [
						// 'per_id_padre',
						'descripcion',
						'imagen',
						'estado',
					];

}
