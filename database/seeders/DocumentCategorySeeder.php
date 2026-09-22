<?php

namespace Database\Seeders;

use App\Models\DocumentCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DocumentCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'SK Pendirian', 'slug' => Str::slug('SK Pendirian')],
            ['name' => 'Akreditasi', 'slug' => Str::slug('Akreditasi')],
            ['name' => 'Standar Pelayanan', 'slug' => Str::slug('Standar Pelayanan')],
            ['name' => 'SOP', 'slug' => Str::slug('SOP')],
            ['name' => 'Laporan Tahunan', 'slug' => Str::slug('Laporan Tahunan')],
            ['name' => 'Peraturan', 'slug' => Str::slug('Peraturan')],
        ];

        foreach ($categories as $category) {
            DocumentCategory::create($category);
        }
    }
}
