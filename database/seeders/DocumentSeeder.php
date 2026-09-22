<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    public function run(): void
    {
        $categories = DocumentCategory::all()->keyBy('slug');

        $documents = [
            // SK Pendirian
            [
                'category_slug' => 'sk-pendirian',
                'code' => 'SK/PEND/001',
                'name' => 'SK Pendirian PPM Poltekkes Medan',
                'published_year' => 2015,
                'file_path' => 'documents/sk-pendirian-2015.pdf',
            ],
            [
                'category_slug' => 'sk-pendirian',
                'code' => 'SK/PEND/002',
                'name' => 'SK Pengesahan Organisasi',
                'published_year' => 2016,
                'file_path' => 'documents/sk-pengesahan-2016.pdf',
            ],

            // Akreditasi
            [
                'category_slug' => 'akreditasi',
                'code' => 'AKR/001',
                'name' => 'Sertifikat Akreditasi Program Studi Keperawatan',
                'published_year' => 2022,
                'file_path' => 'documents/akreditasi-keperawatan-2022.pdf',
            ],
            [
                'category_slug' => 'akreditasi',
                'code' => 'AKR/002',
                'name' => 'Sertifikat Akreditasi Program Studi Kebidanan',
                'published_year' => 2023,
                'file_path' => 'documents/akreditasi-kebidanan-2023.pdf',
            ],

            // Standar Pelayanan
            [
                'category_slug' => 'standar-pelayanan',
                'code' => 'SP/001',
                'name' => 'Standar Pelayanan Minimal Keperawatan',
                'published_year' => 2020,
                'file_path' => 'documents/sp-keperawatan-2020.pdf',
            ],
            [
                'category_slug' => 'standar-pelayanan',
                'code' => 'SP/002',
                'name' => 'Standar Pelayanan Minimal Kebidanan',
                'published_year' => 2020,
                'file_path' => 'documents/sp-kebidanan-2020.pdf',
            ],

            // SOP
            [
                'category_slug' => 'sop',
                'code' => 'SOP/001',
                'name' => 'SOP Pelayanan Rawat Jalan',
                'published_year' => 2021,
                'file_path' => 'documents/sop-rawat-jalan-2021.pdf',
            ],
            [
                'category_slug' => 'sop',
                'code' => 'SOP/002',
                'name' => 'SOP Pelayanan Farmasi Klinik',
                'published_year' => 2021,
                'file_path' => 'documents/sop-farmasi-2021.pdf',
            ],
            [
                'category_slug' => 'sop',
                'code' => 'SOP/003',
                'name' => 'SOP Pengelolaan Rekam Medis',
                'published_year' => 2022,
                'file_path' => 'documents/sop-rekam-medis-2022.pdf',
            ],

            // Laporan Tahunan
            [
                'category_slug' => 'laporan-tahunan',
                'code' => 'LT/001',
                'name' => 'Laporan Tahunan 2022',
                'published_year' => 2022,
                'file_path' => 'documents/laporan-tahunan-2022.pdf',
            ],
            [
                'category_slug' => 'laporan-tahunan',
                'code' => 'LT/002',
                'name' => 'Laporan Tahunan 2023',
                'published_year' => 2023,
                'file_path' => 'documents/laporan-tahunan-2023.pdf',
            ],
            [
                'category_slug' => 'laporan-tahunan',
                'code' => 'LT/003',
                'name' => 'Laporan Tahunan 2024',
                'published_year' => 2024,
                'file_path' => 'documents/laporan-tahunan-2024.pdf',
            ],

            // Peraturan
            [
                'category_slug' => 'peraturan',
                'code' => 'PER/001',
                'name' => 'Peraturan Internal PPM Poltekkes Medan',
                'published_year' => 2021,
                'file_path' => 'documents/peraturan-internal-2021.pdf',
            ],
            [
                'category_slug' => 'peraturan',
                'code' => 'PER/002',
                'name' => 'Peraturan Menteri Kesehatan Terkait PPM',
                'published_year' => 2022,
                'file_path' => 'documents/permenkes-ppm-2022.pdf',
            ],
        ];

        foreach ($documents as $doc) {
            $categorySlug = $doc['category_slug'];
            unset($doc['category_slug']);

            if ($categories->has($categorySlug)) {
                $categories->get($categorySlug)->documents()->create($doc);
            }
        }
    }
}
