<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
	protected $table = 'users';
	const PAGINATOR = 2;
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
			'email', 'password', 'statusId'
	];
	
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
			'remember_token',
	];
	
	public function getListUsers(){
		try {
			$sql = self::select(
					"users.id", 
					"users.email", 
					"iu.name", 
					"iu.lastName", 
					"iu.birthDate")
			->join("informationUsers as iu", "iu.userId", "=", "users.id")
			->orderBy("users.id", "asc")
			->simplePaginate(self::PAGINATOR);
			return $sql;
		}catch (\Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
	
	public function getUserinformationById($userId){
		try {
			$sql = self::select(
					"users.email",
					"users.statusId",
					"iu.name",
					"iu.lastName",
					"iu.birthDate",
					"iu.phone",
					"iu.card")
					->join("informationUsers as iu", "iu.userId", "=", "users.id")
					->where("users.id", $userId)
					->first();
			
					return $sql;
		}catch (\Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
	
	public function searchingByUser($like){
		try {
			$value = "%{$like}%";
			$sql = self::select(
					"users.id",
					"users.email",
					"iu.name",
					"iu.lastName",
					"iu.birthDate")
					->join("informationUsers as iu", "iu.userId", "=", "users.id")
					->where("users.id", "like", $value)
					->orWhere("users.email", "like", $value)
					->orWhere("iu.name", "like", $value)
					->orWhere("iu.lastName", "like", $value)
					->orderBy("users.id", "asc")
					->simplePaginate(self::PAGINATOR);
					return $sql;
		}catch (\Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
}
