<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\SocialSetting;
use App\Models\ApiSetting;
use Illuminate\Support\Facades\Storage;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menambahkan setting umum
        $setting = Setting::create([
            'name' => 'DMD Shoes',
            'alias' => 'dmd-shoes',
            'logo' => 'storage/images/logo.png', // Ganti dengan logo yang sesuai
            'favicon' => 'storage/images/favicon.ico', // Ganti dengan favicon yang sesuai
            'description' => 'Toko sepatu DMD Shoes, jual sepatu berkualitas',
            'email' => 'contact@dmdshoes.com',
            'phone' => '+6281234567890',
            'address' => 'Jl. Raya No. 123, Jakarta, Indonesia',
            'latitude' => -6.2088,
            'longitude' => 106.8456,
            'is_maintenance' => false,
            'app_key' => 'your-app-key-here',
        ]);

        // Menambahkan pengaturan sosial media
        $socialSettings = [
            ['name' => 'Facebook', 'icon' => 'fab fa-facebook', 'url' => 'https://facebook.com/dmdshoes'],
            ['name' => 'Instagram', 'icon' => 'fab fa-instagram', 'url' => 'https://instagram.com/dmdshoes'],
            ['name' => 'Twitter', 'icon' => 'fab fa-twitter', 'url' => 'https://twitter.com/dmdshoes'],
        ];

        foreach ($socialSettings as $social) {
            SocialSetting::create([
                'setting_id' => $setting->id,
                'name' => $social['name'],
                'icon' => $social['icon'],
                'url' => $social['url'],
            ]);
        }

        // Menambahkan pengaturan API
        ApiSetting::create([
            'setting_id' => $setting->id,
            'api_name' => 'Payment Gateway',
            'api_key' => 'your-api-key',
            'api_secret' => 'your-api-secret',
        ]);
    }
}
