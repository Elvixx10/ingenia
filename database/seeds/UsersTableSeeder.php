<?php
use Illuminate\Database\Seeder;
use App\Models\Status;
use App\Models\Users;
use App\Models\InformationUsers;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
	private $insert=[];
	
	public function __construct(){
		$this->insert=[
			[
					'name' => 'a',
					'email' => 'a@a.com',
					'password' => '123456789',
					'statusId' => Status::ACTIVE,
					'lastName' => 'a',
					'birthDate' => date('Y-m-d H:m:i'),
					'phone' => '5574960100',
					'card' => '0000000000000000'
			],
			[
					'name' => 'b',
					'email' => 'b@a.com',
					'password' => '123456789',
					'statusId' => Status::ACTIVE,
					'lastName' => 'b',
					'birthDate' => date('Y-m-d H:m:i'),
					'phone' => '5574960102',
					'card' => '0000000000000001'
			],
		];
	}
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$users = new Users;
		$count = $users->count();
		if ($count< 1) {
			foreach ($this->insert as $value){
				
				$users = Users::create([
						'email' => $value['email'],
						'password' =>bcrypt($value['password']),
						'statusId'=> $value['statusId']
				]);
				
				InformationUsers::create([
					'name' => $value['name'],
					'lastName' => $value['lastName'],
					'birthDate' => $value['birthDate'],
					'phone' => $value['phone'],
					'card' => $value['card'],
					'userId' => $users->id
				]);
			}
		}
	}
	
	public function down()
	{
		DB::table('users')->delete();
	}
}