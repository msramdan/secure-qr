<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Business;
use App\Models\QrCode;
use Illuminate\Support\Str;
use App\Models\RequestQrcode;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // first seeder
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            SettingWebSeeder::class,
            CategorySeeder::class,
            TypeQrcodeSeeder::class,
            DumyDataSeeder::class,
        ]);
        
        // second seeder after request qrcode done
        // $this->call([
        //     ProductScannedSeeder::class,
        // ]);
    }
}
