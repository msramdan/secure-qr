<?php

namespace Database\Seeders;

use App\Models\ProductScanned as CST;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductScanned extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 51; $i < 70; $i++) {
            CST::create([
                'qr_code_id' => fake()->numberBetween(51, 90),
                'kota' => 'Kabupaten Sumenep',
                'lat' => '-6.9043928',
                'long' => '112.965444',
                'visitor' => fake()->ipv4(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
