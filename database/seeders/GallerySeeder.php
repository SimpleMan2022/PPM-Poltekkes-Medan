<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $galleries = [
            [
                'title' => 'Upacara Hari Kesehatan Nasional',
                'image' => 'images/galleries/harga-nas-2024.jpg',
                'event_date' => '2024-11-12',
                'description' => 'Peringatan Hari Kesehatan Nasional ke-60 di Poltekkes Kemenkes Medan.',
            ],
            [
                'title' => 'Pelatihan Pelayanan Kesehatan',
                'image' => 'images/galleries/pelatihan-2024.jpg',
                'event_date' => '2024-09-15',
                'description' => 'Pelatihan peningkatan mutu pelayanan kesehatan bagi tenaga kesehatan.',
            ],
            [
                'title' => 'Bakti Sosial Masyarakat',
                'image' => 'images/galleries/bakti-sosial-2024.jpg',
                'event_date' => '2024-08-20',
                'description' => 'Kegiatan bakti sosial pelayanan kesehatan gratis untuk masyarakat sekitar.',
            ],
            [
                'title' => 'Seminar Kesehatan Reproduksi',
                'image' => 'images/galleries/seminar-2024.jpg',
                'event_date' => '2024-07-10',
                'description' => 'Seminar kesehatan reproduksi remaja berkolaborasi dengan Dinas Kesehatan.',
            ],
            [
                'title' => 'Wisuda Angkatan XXV',
                'image' => 'images/galleries/wisuda-2024.jpg',
                'event_date' => '2024-06-28',
                'description' => 'Wisuda angkatan ke-25 Program Studi Poltekkes Kemenkes Medan.',
            ],
            [
                'title' => 'Workshop Akreditasi',
                'image' => 'images/galleries/workshop-akreditasi-2024.jpg',
                'event_date' => '2024-05-18',
                'description' => 'Workshop persiapan akreditasi program studi bersama LAM-PTKes.',
            ],
            [
                'title' => 'Posyandu Balita',
                'image' => 'images/galleries/posyandu-2024.jpg',
                'event_date' => '2024-04-05',
                'description' => 'Kegiatan posyandu balita rutin bulanan di lingkungan Poltekkes.',
            ],
            [
                'title' => 'Hari Jadi Poltekkes Medan',
                'image' => 'images/galleries/hari-jadi-2024.jpg',
                'event_date' => '2024-03-01',
                'description' => 'Peringatan hari jadi Poltekkes Kemenkes Medan.',
            ],
        ];

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }
    }
}
