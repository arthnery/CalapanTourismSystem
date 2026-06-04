<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\TourismSpot;
use App\Models\Category;

class TourismSpotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $beach = Category::where('name', 'Beaches')->first();
        $history = Category::where('name', 'Historical Sites')->first();
        $nature = Category::where('name', 'Nature & Parks')->first();

        TourismSpot::create([
            'name' => 'Bulusan Park',
            'description' => 'A serene park perfect for families and relaxation.',
            'location' => 'Calapan City, Oriental Mindoro',
            'category_id' => $nature->id,
            'price' => 0.00,
            'image_path' => 'bulusan.jpg' // Placeholder
        ]);

        TourismSpot::create([
            'name' => 'Calapan City Plaza',
            'description' => 'The heart of Calapan City, featuring historical monuments.',
            'location' => 'Poblacion, Calapan City',
            'category_id' => $history->id,
            'price' => 0.00,
            'image_path' => 'spots/calapancityplaza.jpg'
        ]);

        TourismSpot::create([
            'name' => 'Aplaya Beach',
            'description' => 'A popular local beach with stunning sunset views.',
            'location' => 'Barangay Lazareto, Calapan City',
            'category_id' => $beach->id,
            'price' => 50.00,
            'image_path' => 'spots/aplayabeach.jpg'
        ]);
    }
}
