<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::updateOrCreate(
            ['id' => 1],
            [
            'site_name' => 'PPM Poltekkes Kemenkes',
            'logo' => 'images/logo.png',
            'address' => 'Jl. Brigjend Katamso No. 103, Medan, Sumatera Utara 20126',
            'phone' => '(061) 8455651',
            'whatsapp' => '0811-6000-0000',
            'email' => 'ppm@poltekkesmedan.ac.id',
            'operating_hours' => 'Senin - Jumat: 08.00 - 16.00 WIB',
            'instagram_url' => 'https://instagram.com/ppmpoltekkesmedan',
            'facebook_url' => 'https://facebook.com/ppmpoltekkesmedan',
            'youtube_url' => 'https://youtube.com/@ppmpoltekkesmedan',
            'google_maps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3921.8!2d98.68!3d3.58!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'copyright_text' => '&copy; 2025 PPM Poltekkes Kemenkes Medan. All Rights Reserved.',
            ]
        );
    }
}
