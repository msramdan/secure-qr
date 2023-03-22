<?php

namespace Database\Seeders;

use App\Models\Partner;
use App\Models\Product;
use App\Models\Business;
use Illuminate\Support\Str;
use App\Models\RequestQrcode;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DumyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $partner = \App\Models\Partner::create([
            'name' => 'reald',
            'phone' => '0123456789',
            'pic' => 'rahman',
            'photo' => 'default.jpg',
            'address' => 'Surabaya',
            'email' => 'reald@labelin.co',
            'email_verified_at' => now(),
            'password' => bcrypt('mocachino18@')
        ]);
        $bisnis = ['Ms Glow', 'Real D', 'KF Skincare'];
        $product = ['Whitening Gold', 'Serum', 'Tonner'];
        for ($i = 0; $i < 3; $i++) {
            $business = \App\Models\Business::create([
                'partner_id' => $partner->id,
                'name' => $bisnis[$i],
                'brand' => $bisnis[$i],
                'logo' => 'logo.png',
                'manufacture' => 'Surabaya'
            ]);
            $produk = \App\Models\Product::create([
                'category_id' => 5,
                'business_id' => $business->id,
                'partner_id' => 1,
                'production_code' => 'RD1122245',
                'name' => $product[$i],
                'slug' => Str::slug($product[$i]),
                'bpom' => 'NA999347623',
                'description' => $product[$i],
                'expired_date' => now(),
                'netto' => '10ML',
                'photo' => 'photo.png'
            ]);
            \App\Models\RequestQrcode::create([
                'partner_id' => $partner->id,
                'product_id' => $produk->id,
                'type_qrcode_id' => 1,
                'tanggal_request' => now(),
                'qty' => 5,
                'sn_length' => 8,
                'harga_satuan' => 1000,
                'amount_price' => 5000,
                'status' => 'Waiting Payment',
            ]);
        }
    }
}
