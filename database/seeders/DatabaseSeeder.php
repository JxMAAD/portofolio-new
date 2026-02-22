<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       // Admin User
        $admin = User::create([
            'username' => 'jxmaad',
            'email' => 'jxmaad12@gamil.com',
            'password' => Hash::make('cihuy2212'), // Ganti dengan password yang aman
        ]);

        Profile::create([
            'user_id' => $admin->id,
            'name' => 'Hilal Ahmad Mujaddid',
            'title' => 'Junior Web Developer',
            'bio' => 'Saya adalah seorang junior web developer dengan pengalaman dalam pengembangan aplikasi web menggunakan Laravel. Saya memiliki kemampuan dalam mengelola database, membuat API, dan mengembangkan fitur-fitur yang responsif. Saya juga memiliki minat dalam desain UI/UX dan selalu berusaha untuk meningkatkan keterampilan saya di bidang ini.',
            'photo' => null,
            'cv' => null,
        ]);
    }
}
