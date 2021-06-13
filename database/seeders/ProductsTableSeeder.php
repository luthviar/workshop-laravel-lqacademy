<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Products;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //cara pertama
        // $products = [
        //     [ 
                // 'name' => "judul produk 1",
                // 'description' => "Deskripsi produk 1",
                // 'price' => 10000,
                // 'url_image' =>'http://lorempixel.com/450/300/food/',
                // 'created_by' => 1,
                // 'status'=> 1
        //     ],
        //     [ 
        //         'name' => "judul produk 2",
        //         'description' => "Deskripsi produk 2",
        //         'price' => 20000,
        //         'url_image' =>'http://lorempixel.com/450/300/food/',
        //         'created_by' => 1,
                // 'status'=> 1
        //     ],
        //     [ 
        //         'name' => "judul produk 3",
        //         'description' => "Deskripsi produk 3",
        //         'price' => 30000,
        //         'url_image' =>'http://lorempixel.com/450/300/food/',
        //         'created_by' => 1,
        //          'status'=> 1
        //     ]
        // ];

        // Products::insert($products); 


        //cara kedua
        $faker = Faker::create('id_ID');
        $max_data = 50;
        $created_by_default = 1;
        $faker->addProvider(new \FakerRestaurant\Provider\id_ID\Restaurant($faker));

    	for($i = 1; $i <= $max_data; $i++){
    	    // insert data ke table pegawai menggunakan Faker

            // cara insert #1
    		Products::insert([
    			'name' => $faker->foodName(),
    			'description' => $faker->text,
    			'price' => $faker->numberBetween(10000,100000),
    			// 'url_image' => $faker->imageUrl(450, 300, 'food'),
                'url_image' => 'https://lorempixel.com/450/300/food/'.$faker->numberBetween(1,10), 
                'created_by' => is_null(User::find($i))?$created_by_default:$i,
                'status'=> $faker->numberBetween(0,1)
    		]); 

            // cara insert #2
            // DB::table("products")->insert([
            //      'name' => $faker->title,
    		// 	    'description' => $faker->text,
    		//  	'price' => $faker->numberBetween(25,40),
    		//  	'url_image' => $faker->imageUrl(450, 300, 'food'),
            //      'created_by' => is_null(User::find($i))?$created_by_default:$i
            // ]);
    	}
        
    }
}
