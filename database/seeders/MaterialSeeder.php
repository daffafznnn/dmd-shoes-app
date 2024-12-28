<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ProductMaterial;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Kulit',
                'slug' => 'kulit',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Plastik',
                'slug' => 'plastik',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        ProductMaterial::insert($data);
    }
}