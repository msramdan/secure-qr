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
        \App\Models\Partner::create([
            'name' => 'demo',
            'phone' => '928493282',
            'pic' => 'Ms Glow',
            'photo' => 'photo.jpg',
            'address' => 'Gadu Barat Ganding Sumenep',
            'email' => 'demo@labelin.co',
            'email_verified_at' => now(),
            'password' => bcrypt('mocachino')
        ]);
    }
}
