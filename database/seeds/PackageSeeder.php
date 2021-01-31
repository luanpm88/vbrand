<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\myclass\Slug;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slug = new Slug();
        $fake  = Faker\Factory::create();
        $limit = 3;

        for ($i = 0; $i < $limit; $i++){
        	$title = $fake->name;
            DB::table('package')->insert([
                'title' => $title,  
                'slug'	=> $slug->createSlug($title),
                'description' => $fake->sentence(15),
                'status'=>1,
                'price' => rand(200000,900000), 
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"), 
            ]);
        }
    }
}
