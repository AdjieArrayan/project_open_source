<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('menus')->insert([
            [
                'nama_menu' => 'Cendol Original',
                'deskripsi' => 'Cendol klasik dengan santan dan gula merah.',
                'harga' => 5000,
                'gambar' => 'cendol_original.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'Cendol Durian',
                'deskripsi' => 'Cendol dengan topping durian asli.',
                'harga' => 8000,
                'gambar' => 'cendol_durian.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'Es Dawet Ayu',
                'deskripsi' => 'Dawet khas Banjarnegara yang segar.',
                'harga' => 6000,
                'gambar' => 'es_dawet.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'Es Dawet Ayu',
                'deskripsi' => 'Dawet khas Banjarnegara yang segar.',
                'harga' => 6000,
                'gambar' => 'es_dawet.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'Es Dawet Ayu',
                'deskripsi' => 'Dawet khas Banjarnegara yang segar.',
                'harga' => 6000,
                'gambar' => 'es_dawet.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'Es Dawet Ayu',
                'deskripsi' => 'Dawet khas Banjarnegara yang segar.',
                'harga' => 6000,
                'gambar' => 'es_dawet.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
