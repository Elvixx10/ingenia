<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformationUsers extends Model
{
	protected $table = 'informationUsers';
	
	protected $casts = [
		'birthDate' => 'datetime:d/m/Y'
	];
	
	protected $fillable = ['name', 'lastName', 'birthDate', 'phone', 'card', 'userId'];
}
