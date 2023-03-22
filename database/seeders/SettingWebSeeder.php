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
        SettingWeb::create([
            'nama_website' => 'Labelin.co',
            'kode_website' => '423954',
            'logo_dark' => 'logo_dark.png',
            'logo_light' => 'logo_light.png',
            'telpon' => '081299903331',
            'email' => 'info@labelin.co',
            'alamat' => 'Surabaya',
            'deskripsi' => 'Labelin.co merupakan layanan tag API printing berteknologi dalam bentuk label yang bisa di tempel pada produk. Dengan Labelin.co para business owner dapat menjaga originalitas produk/karya mereka hingga sampai ke tangan customer dengan membedakan produk asli dan palsu di pasaran.',
            'url_wa_gateway' => 'http://103.176.79.206:40000/',
            'session_wa_gateway' => 'secure_tag',
            'is_aktif' => true
        ]);
    }
}
