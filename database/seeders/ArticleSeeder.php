<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $categories = Category::all();
        $tags = Tag::all();

        $articles = [
            // Panduan Memulai
            [
                'title' => 'Cara Membuat Akun Baru',
                'content' => $this->generateContent('Panduan lengkap untuk membuat akun baru di platform kami. Ikuti langkah-langkah berikut untuk memulai.'),
                'category' => 'panduan-memulai',
                'status' => 'published',
                'is_featured' => true,
                'tags' => ['pemula', 'tutorial'],
            ],
            [
                'title' => 'Pengaturan Profil Pengguna',
                'content' => $this->generateContent('Pelajari cara mengatur profil pengguna Anda termasuk foto profil, informasi kontak, dan preferensi notifikasi.'),
                'category' => 'panduan-memulai',
                'status' => 'published',
                'is_featured' => false,
                'tags' => ['pemula', 'tips'],
            ],
            [
                'title' => 'Memahami Dashboard Utama',
                'content' => $this->generateContent('Penjelasan komprehensif tentang fitur-fitur yang tersedia di dashboard utama.'),
                'category' => 'panduan-memulai',
                'status' => 'published',
                'is_featured' => false,
                'tags' => ['pemula', 'tutorial'],
            ],

            // Fitur & Fungsi
            [
                'title' => 'Manajemen Pengguna dan Peran',
                'content' => $this->generateContent('Pelajari cara mengelola pengguna, membuat peran baru, dan mengatur izin akses.'),
                'category' => 'fitur-dan-fungsi',
                'status' => 'published',
                'is_featured' => true,
                'tags' => ['lanjutan', 'keamanan'],
            ],
            [
                'title' => 'Sistem Notifikasi',
                'content' => $this->generateContent('Cara mengkonfigurasi dan mengelola notifikasi email, push, dan in-app.'),
                'category' => 'fitur-dan-fungsi',
                'status' => 'published',
                'is_featured' => false,
                'tags' => ['tips', 'baru'],
            ],
            [
                'title' => 'Fitur Pencarian Lanjutan',
                'content' => $this->generateContent('Gunakan operator pencarian lanjutan untuk menemukan konten dengan lebih cepat dan akurat.'),
                'category' => 'fitur-dan-fungsi',
                'status' => 'draft',
                'is_featured' => false,
                'tags' => ['lanjutan', 'tips'],
            ],

            // Integrasi
            [
                'title' => 'Integrasi dengan Google Analytics',
                'content' => $this->generateContent('Panduan langkah demi langkah untuk mengintegrasikan Google Analytics ke platform Anda.'),
                'category' => 'integrasi',
                'status' => 'published',
                'is_featured' => false,
                'tags' => ['tutorial', 'api'],
            ],
            [
                'title' => 'Menghubungkan dengan Slack',
                'content' => $this->generateContent('Aktifkan notifikasi Slack untuk mendapatkan update real-time.'),
                'category' => 'integrasi',
                'status' => 'published',
                'is_featured' => false,
                'tags' => ['tutorial', 'baru'],
            ],

            // FAQ
            [
                'title' => 'Bagaimana Cara Reset Password?',
                'content' => $this->generateContent('Langkah-langkah untuk mereset password jika Anda lupa.'),
                'category' => 'faq',
                'status' => 'published',
                'is_featured' => false,
                'tags' => ['pemula', 'keamanan'],
            ],
            [
                'title' => 'Apakah Data Saya Aman?',
                'content' => $this->generateContent('Penjelasan tentang keamanan data dan enkripsi yang kami gunakan.'),
                'category' => 'faq',
                'status' => 'published',
                'is_featured' => true,
                'tags' => ['penting', 'keamanan'],
            ],
            [
                'title' => 'Cara Menghubungi Support',
                'content' => $this->generateContent('Berbagai cara untuk menghubungi tim support kami.'),
                'category' => 'faq',
                'status' => 'published',
                'is_featured' => false,
                'tags' => ['pemula'],
            ],

            // Troubleshooting
            [
                'title' => 'Mengatasi Error Login',
                'content' => $this->generateContent('Solusi untuk berbagai masalah yang mungkin terjadi saat login.'),
                'category' => 'troubleshooting',
                'status' => 'published',
                'is_featured' => false,
                'tags' => ['pemula', 'tips'],
            ],
            [
                'title' => 'Halaman Tidak Dapat Dimuat',
                'content' => $this->generateContent('Cara mengatasi masalah ketika halaman tidak dapat dimuat.'),
                'category' => 'troubleshooting',
                'status' => 'published',
                'is_featured' => false,
                'tags' => ['tips'],
            ],
            [
                'title' => 'Optimasi Performa Aplikasi',
                'content' => $this->generateContent('Tips untuk mengoptimalkan performa aplikasi.'),
                'category' => 'troubleshooting',
                'status' => 'draft',
                'is_featured' => false,
                'tags' => ['lanjutan', 'performa'],
            ],

            // API Documentation
            [
                'title' => 'Memulai dengan REST API',
                'content' => $this->generateContent('Pengenalan REST API dan cara mendapatkan API key.'),
                'category' => 'api-documentation',
                'status' => 'published',
                'is_featured' => true,
                'tags' => ['api', 'tutorial'],
            ],
            [
                'title' => 'Autentikasi API',
                'content' => $this->generateContent('Cara mengautentikasi request API menggunakan Bearer token.'),
                'category' => 'api-documentation',
                'status' => 'published',
                'is_featured' => false,
                'tags' => ['api', 'keamanan'],
            ],
            [
                'title' => 'Rate Limiting dan Best Practices',
                'content' => $this->generateContent('Penjelasan tentang rate limiting dan praktik terbaik penggunaan API.'),
                'category' => 'api-documentation',
                'status' => 'draft',
                'is_featured' => false,
                'tags' => ['api', 'performa', 'lanjutan'],
            ],
        ];

        foreach ($articles as $articleData) {
            $category = $categories->where('slug', $articleData['category'])->first();

            $article = Article::create([
                'title' => $articleData['title'],
                'slug' => Str::slug($articleData['title']),
                'content' => $articleData['content'],
                'status' => $articleData['status'],
                'is_featured' => $articleData['is_featured'],
                'views' => rand(10, 500),
                'category_id' => $category->uuid,
                'user_id' => $user->uuid,
            ]);

            // Attach tags
            $tagIds = $tags->whereIn('slug', $articleData['tags'])->pluck('uuid');
            $article->tags()->attach($tagIds);
        }
    }

    private function generateContent(string $intro): string
    {
        return <<<HTML
<h2>{$intro}</h2>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

<h3>Langkah-langkah</h3>

<ol>
    <li><strong>Langkah Pertama:</strong> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</li>
    <li><strong>Langkah Kedua:</strong> Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</li>
    <li><strong>Langkah Ketiga:</strong> Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</li>
</ol>

<h3>Informasi Penting</h3>

<blockquote>
    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
</blockquote>

<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>

<h3>Tips Tambahan</h3>

<ul>
    <li>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam.</li>
    <li>Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur.</li>
    <li>Vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.</li>
</ul>

<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident.</p>
HTML;
    }
}
