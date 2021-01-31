<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\myclass\Slug;
class TemplateSeeder extends Seeder
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
        $limit = 6;
        for ($i = 0; $i < $limit; $i++){
        	$title = $fake->name;
            DB::table('template')->insert([
                'title' => $title,  
                'slug'	=> $slug->createSlug($title),
                'status'=>1,
                'description' => $fake->sentence(15),
                'price' => rand(200000,900000),
                'photo' => 'giao-dien-'.($i+1).'.jpg',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"), 
            ]);
        }
    }
}
