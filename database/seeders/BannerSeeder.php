<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'title' => 'PPM Poltekkes Kemenkes Medan',
                'subtitle' => 'Pusat Pengembangan Mutu Politeknik Kesehatan Kementerian Kesehatan Medan',
                'image' => 'images/banners/banner-1.jpg',
                'cta_text' => 'Pelajari Lebih Lanjut',
                'cta_url' => '#tentang-kami',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Pelayanan Kesehatan Terpadu',
                'subtitle' => 'Melayani masyarakat dengan profesional dan penuh dedikasi',
                'image' => 'images/banners/banner-2.jpg',
                'cta_text' => 'Lihat Layanan',
                'cta_url' => '#layanan',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Pendidikan & Pelatihan',
                'subtitle' => 'Mencetak tenaga kesehatan yang kompeten dan berdaya saing',
                'image' => 'images/banners/banner-3.jpg',
                'cta_text' => 'Info Selengkapnya',
                'cta_url' => '#layanan',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}
