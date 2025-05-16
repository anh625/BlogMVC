<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            ['category_name' => 'Technology'],
            ['category_name' => 'Lifestyle'],
            ['category_name' => 'Education'],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'category_name' => $category['category_name'],
                'category_slug' => Str::slug($category['category_name']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
