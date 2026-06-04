<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Beaches', 'description' => 'Beautiful sandy shores and crystal clear waters.'],
            ['name' => 'Historical Sites', 'description' => 'Rich history and cultural heritage sites.'],
            ['name' => 'Nature & Parks', 'description' => 'Lush green parks and natural wonders.'],
            ['name' => 'Adventure', 'description' => 'Exciting outdoor activities and adventures.'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
