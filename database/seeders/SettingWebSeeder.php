<?php

namespace Database\Seeders;

use App\Models\SettingWeb;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingWebSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingWeb::insert([
            'nama_website' => 'labelin.co',
            'kode_website' => fake()->numberBetween(1, 7),
            'logo_dark' => 'logo_dark.png',
            'logo_light' => 'logo_light.png',
            'telpon' => '0123456789',
            'email' => 'admin@labelin.co',
            'alamat' => 'Surabaya',
            'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi nam repellat maxime cupiditate mollitia ea rem cumque nulla voluptates sequi?',
            'is_aktif' => false
        ]);
    }
}
