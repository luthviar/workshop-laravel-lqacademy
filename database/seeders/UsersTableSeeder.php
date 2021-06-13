<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //cara kedua
        $idRoles = DB::table('roles')->pluck('id')->toArray();
        $faker = Faker::create('id_ID');
        $max_data = 50;
    	for($i = 1; $i <= $max_data; $i++){
    	    // insert data ke table pegawai menggunakan Faker
    		$user = User::create([
    			'name' => $faker->name,
    			'email' => $faker->email,
    			'password' => bcrypt('password123')                
    		]);
 
            $user->roles()->sync([$faker->randomElement($idRoles)]);
    	}
    }
}
