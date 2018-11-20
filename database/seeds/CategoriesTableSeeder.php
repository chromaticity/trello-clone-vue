<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = ['Needs Discussion', 'In Progress', 'Done', 'Pushed'];

        foreach ($categories as $category) {
        	# code...
        	Category::create(['name' => $category]);
        }
    }
}
