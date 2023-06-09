<?php

namespace Database\Seeders;

use App\Models\TypeQrcode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeQrcodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeQrcode::create([
            'name' => 'Label thermal (3x1,5cm) Portrait',
            'price' => 350,
            'photo' => 'qrcode.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        TypeQrcode::create([
            'name' => 'Label thermal (3x1,5cm) Landscape',
            'price' => 350,
            'photo' => 'qrcode.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        TypeQrcode::create([
            'name' => '	Label Vinyl (3x1,5cm) Portrait',
            'price' => 900,
            'photo' => 'qrcode.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        TypeQrcode::create([
            'name' => 'Label Vinyl (3x1,5cm) Landscape',
            'price' => 900,
            'photo' => 'qrcode.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        TypeQrcode::create([
            'name' => '	Label hologram (3x1,5cm) Landscape',
            'price' => 1000,
            'photo' => 'qrcode.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        TypeQrcode::create([
            'name' => '	Label hologram (3x1,5cm) Portrait',
            'price' => 1000,
            'photo' => 'qrcode.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
