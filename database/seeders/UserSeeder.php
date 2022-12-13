<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'admin@labelin.co',
                'password' => Hash::make('mocachino'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);

        $partner = new User();
        $partner->name = 'Demo Partner';
        $partner->email = 'demo@labelin.co';
        $partner->password = Hash::make('mocachino');
        $partner->remember_token = Str::random(10);
        $partner->save();
        DB::table('user_partners')->insert([
            'user_id' => $partner->id,
            'code' => fake()->randomNumber(7),
            'phone' => fake()->phoneNumber(),
            'pic' => 'MS Glow',
            'photo' => 'demo.png',
            'address' => 'Surabaya',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
