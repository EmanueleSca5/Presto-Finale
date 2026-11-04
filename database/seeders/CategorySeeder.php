<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            "Veicoli",
            "Oggetti per la casa",
            "Elettronica",
            "Abbigliamento",
            "Sport",
            "Giochi",
            "Svago",
            "Scuola",
            "Arte",
            "Film",
        ];

        foreach($categories as $name){
            Category::firstOrCreate(["name" => $name]);
        }
    }
}
