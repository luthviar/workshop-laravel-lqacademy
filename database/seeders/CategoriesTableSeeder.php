<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categories;

use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //cara pertama
        $categories = [
            [
                'id' => 1,
                'name' => 'Makanan' 
            ],
            [
                'id' => 2,
                'name' => 'Minuman' 
            ],
            [
                'id' => 3,
                'name' => 'Elektronik' 
            ],
            [
                'id' => 4,
                'name' => 'Fashion' 
            ],
        ];

        Categories::insert($categories);

        //cara kedua
        // $faker = Faker::create('id_ID');
        // $max_data = 10;
        // $created_by_default = 1;
    	// for($i = 1; $i <= $max_data; $i++){
    	//     // insert data ke table pegawai menggunakan Faker

        //     // cara insert #1
    	// 	Categories::insert([
    	// 		'name' => $faker->name    		
    	// 	]); 
           
    	// }
    }
}
