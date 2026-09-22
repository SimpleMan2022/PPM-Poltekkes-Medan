<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SiteSettingSeeder::class,
            OrganizationProfileSeeder::class,
            BannerSeeder::class,
            ServiceSeeder::class,
            RelatedLinkSeeder::class,
            DocumentCategorySeeder::class,
            DocumentSeeder::class,
            GallerySeeder::class,
            PersonnelSeeder::class,
        ]);
    }
}
