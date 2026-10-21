<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'Pemula', 'slug' => 'pemula', 'description' => 'Konten untuk pengguna pemula'],
            ['name' => 'Lanjutan', 'slug' => 'lanjutan', 'description' => 'Konten untuk pengguna tingkat lanjut'],
            ['name' => 'Tutorial', 'slug' => 'tutorial', 'description' => 'Panduan langkah demi langkah'],
            ['name' => 'Tips', 'slug' => 'tips', 'description' => 'Tips dan trik penggunaan'],
            ['name' => 'Video', 'slug' => 'video', 'description' => 'Konten dengan video tutorial'],
            ['name' => 'Penting', 'slug' => 'penting', 'description' => 'Informasi penting yang harus diketahui'],
            ['name' => 'Baru', 'slug' => 'baru', 'description' => 'Fitur atau konten terbaru'],
            ['name' => 'API', 'slug' => 'api', 'description' => 'Terkait dengan API'],
            ['name' => 'Keamanan', 'slug' => 'keamanan', 'description' => 'Terkait dengan keamanan'],
            ['name' => 'Performa', 'slug' => 'performa', 'description' => 'Terkait dengan optimasi performa'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
