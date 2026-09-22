<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Pelayanan Keperawatan',
                'description' => 'Pelayanan keperawatan profesional yang meliputi asuhan keperawatan individual, kelompok, dan komunitas dengan standar pelayanan terbaik.',
                'icon' => 'heart',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Pelayanan Kebidanan',
                'description' => 'Pelayanan kebidanan yang mencakup ANC, INC, PNC, serta pelayanan kesehatan reproduksi bagi wanita di semua tahap kehidupan.',
                'icon' => 'users',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Pelayanan Farmasi',
                'description' => 'Pelayanan farmasi klinik yang meliputi dispensing obat, konseling obat, dan pelayanan informasi obat kepada pasien dan tenaga kesehatan.',
                'icon' => 'plus-circle',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Pelayanan Gizi',
                'description' => 'Pelayanan gizi klinik yang meliputi asesmen gizi, intervensi gizi, dan konseling gizi untuk pasien rawat inap maupun rawat jalan.',
                'icon' => 'chart-bar',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Pelayanan Kesehatan Lingkungan',
                'description' => 'Pelayanan kesehatan lingkungan yang meliputi pengawasan sanitasi, kualitas air, dan pengendalian faktor risiko lingkungan.',
                'icon' => 'shield-check',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Pelayanan Rekam Medis',
                'description' => 'Pengelolaan rekam medis yang terintegrasi dan terstandarisasi untuk mendukung mutu pelayanan kesehatan.',
                'icon' => 'document-text',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
