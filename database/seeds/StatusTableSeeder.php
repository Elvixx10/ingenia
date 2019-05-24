<?php 

use Illuminate\Database\Seeder;
use App\Models\Status;
use Illuminate\Support\Facades\DB;

class StatusTableSeeder extends Seeder
{

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$status = Status::all();
		$countStatus = count($status);
		if ($countStatus < 1) {
			DB::table('status')->insert([
					[
							'name' => 'Activo'
					],
					[
							'name' => 'Inactivo'
					]
			]);
		}
	}
	
	public function down()
	{
		DB::table('status')->delete();
	}
}