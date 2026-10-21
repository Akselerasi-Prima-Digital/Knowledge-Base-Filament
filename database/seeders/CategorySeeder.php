<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Panduan Memulai',
                'slug' => 'panduan-memulai',
                'description' => 'Dokumentasi untuk memulai menggunakan platform',
                'ordering' => 1,
                'status' => 'published',
            ],
            [
                'name' => 'Fitur & Fungsi',
                'slug' => 'fitur-dan-fungsi',
                'description' => 'Penjelasan lengkap tentang fitur-fitur yang tersedia',
                'ordering' => 2,
                'status' => 'published',
            ],
            [
                'name' => 'Integrasi',
                'slug' => 'integrasi',
                'description' => 'Panduan integrasi dengan layanan pihak ketiga',
                'ordering' => 3,
                'status' => 'published',
            ],
            [
                'name' => 'FAQ',
                'slug' => 'faq',
                'description' => 'Pertanyaan yang sering diajukan',
                'ordering' => 4,
                'status' => 'published',
            ],
            [
                'name' => 'Troubleshooting',
                'slug' => 'troubleshooting',
                'description' => 'Solusi untuk masalah umum',
                'ordering' => 5,
                'status' => 'published',
            ],
            [
                'name' => 'API Documentation',
                'slug' => 'api-documentation',
                'description' => 'Dokumentasi teknis API',
                'ordering' => 6,
                'status' => 'published',
            ],
            [
                'name' => 'Changelog',
                'slug' => 'changelog',
                'description' => 'Riwayat perubahan dan pembaruan',
                'ordering' => 7,
                'status' => 'draft',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
