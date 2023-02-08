<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Business;
use App\Models\Partner;
use App\Models\Product;
use App\Models\RequestQrcode;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            SettingWebSeeder::class,
            CategorySeeder::class,
            TypeQrcodeSeeder::class
        ]);
        $partner = Partner::create([
            'code' => '232dfE34',
            'name' => 'Demo',
            'phone' => '085155353793',
            'pic' => 'Ahmad Muzayyin',
            'photo' => 'photo.jpg',
            'address' => 'Gadu Barat Ganding Sumenep',
            'email' => 'demo@labelin.co',
            'email_verified_at' => now(),
            'password' => bcrypt('mocachino'),
            'remember_token' => 'sd34dISJ34',
        ]);
        $business = Business::create([
            'partner_id' => $partner->id,
            'code' => 2982392,
            'name' => 'Demo Company',
            'brand' => 'Ms Glow',
            'logo' => 'logo,png',
            'manufacture' => 'Surabaya'
        ]);
        $product = Product::create([
            'category_id' => 1,
            'business_id' => $business->id,
            'partner_id' => $partner->id,
            'production_code' => 'SJDI6723',
            'name' => 'Tonner',
            'slug' => 'tonner',
            'bpom' => 'NA928323923',
            'description' => 'Tonner Pencerah Wajah',
            'expired_date' => now(),
            'netto' => '15ML',
            'photo' => 'tonner.png'
        ]);
        for ($i = 0; $i < 50; $i++) {
            RequestQrcode::create([
                'partner_id' => $partner->id,
                'product_id' => $product->id,
                'type_qrcode_id' => 1,
                'code' => 'SLKD34',
                'tanggal_request' => now(),
                'qty' => 50,
                'sn_length' => 5,
                'harga_satuan' => 5000,
                'amount_price' => 50000,
                'status' => 'Waiting Payment',
                'bukti_pembayaran' => '',
                'tgl_upload_bukti_bayar' => now(),
            ]);
        }
    }
}
