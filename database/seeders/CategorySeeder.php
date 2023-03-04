<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([

            'name' => 'Bahan Makanan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Category::create([

            'name' => 'Elektronik',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Category::create([

            'name' => 'Dokumen',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Category::create([

            'name' => 'Farmasi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Category::create([

            'name' => 'Kosmetik',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Category::create([

            'name' => 'Perhiasan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Category::create([

            'name' => 'Fashion',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
