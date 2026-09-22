<?php

namespace Database\Seeders;

use App\Models\RelatedLink;
use Illuminate\Database\Seeder;

class RelatedLinkSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            [
                'name' => 'Kementerian Kesehatan RI',
                'logo' => 'images/links/kemenkes.png',
                'url' => 'https://www.kemkes.go.id',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Poltekkes Kemenkes',
                'logo' => 'images/links/poltekkes.png',
                'url' => 'https://www.poltekkes-kemenkes.ac.id',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'BPOM RI',
                'logo' => 'images/links/bpom.png',
                'url' => 'https://www.pom.go.id',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Dinas Kesehatan Sumut',
                'logo' => 'images/links/dinkes-sumut.png',
                'url' => 'https://dinkes.sumutprov.go.id',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Puskesmas',
                'logo' => 'images/links/puskesmas.png',
                'url' => 'https://puskesmas.kemkes.go.id',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'WHO Indonesia',
                'logo' => 'images/links/who.png',
                'url' => 'https://www.who.int/indonesia',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($links as $link) {
            RelatedLink::create($link);
        }
    }
}
