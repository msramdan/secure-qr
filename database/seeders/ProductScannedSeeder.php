<?php

namespace Database\Seeders;

use App\Models\QrCode;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductScannedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kota1 = ['Surabaya', 'Bangkalan', 'Pasuruan', 'Malang', 'Jakarta'];
        $kota2 = [
            'Kabupaten Aceh Barat',
            'Kabupaten Aceh Barat Daya',
            'Kabupaten Aceh Besar',
            'Kabupaten Aceh Jaya',
            'Kabupaten Aceh Selatan'
        ];
        $kota3 = [
            'Kabupaten Indramayu',
            'Kabupaten Karawang',
            'Kabupaten Kuningan',
            'Kabupaten Majalengka',
            'Kabupaten Pangandaran'
        ];
        $kota4 = [
            'Bangkalan',
            'Sampang',
            'Sumenep',
            'Pasuruan',
            'Pamekasan'
        ];
        $qrcode = QrCode::where('request_qrcode_id', 3)->get();
        foreach ($qrcode as $key => $value) {
            \App\Models\ProductScanned::create([
                'qr_code_id' => $value->id,
                'kota' => $kota4[$key],
                'lat' => fake()->latitude(),
                'long' => fake()->longitude(),
                'visitor' => fake()->ipv4()
            ]);
        }
    }
}
