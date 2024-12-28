<?php

namespace Database\Seeders;

use App\Models\ProductColor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            'Hitam',
            'Putih',
            'Abu-abu',
            'Merah',
            'Biru',
            'Hijau',
        ];

        foreach ($colors as $color) {
            ProductColor::create([
                'name' => $color,
                'slug' => Str::slug($color),
                'status' => true,
            ]);
        }
    }
}

