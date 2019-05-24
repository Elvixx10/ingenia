<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	Model::unguard();
    	$this->call(StatusTableSeeder::class);
    	$this->call(UsersTableSeeder::class);
    	$this->command->info("Seeder created successfully! :)");
    	Model::reguard();
    }
    
}