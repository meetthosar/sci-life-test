<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $global = Category::factory()->create(['name' => 'Global']);
        $continents = Category::factory()->count(7)->create(['parent' => $global->id]);
        foreach ($continents as $continent){
            $countries = Category::factory()->count(10)->create(['parent' => $continent->id]);
        }
    }
}
