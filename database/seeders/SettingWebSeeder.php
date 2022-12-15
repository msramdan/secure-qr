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
            'nama_website' => 'Labelin.co',
            'kode_website' => '423954',
            'logo_dark' => 'logo_dark.png',
            'logo_light' => 'logo_light.png',
            'telpon' => '0123456789',
            'email' => 'admin@labelin.co',
            'alamat' => 'Surabaya',
            'deskripsi' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dicta, quos maxime. Animi est alias porro optio maxime incidunt aspernatur, nesciunt, ab facere distinctio iure. Iste molestias, laudantium nesciunt non consequuntur et possimus a! Obcaecati dolorum placeat rerum fugit, maiores doloremque nobis in accusamus. Asperiores doloribus at nesciunt hic assumenda suscipit!',
            'is_aktif' => false
        ]);
    }
}
