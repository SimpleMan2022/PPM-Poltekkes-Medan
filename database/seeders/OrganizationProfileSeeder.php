<?php

namespace Database\Seeders;

use App\Models\OrganizationProfile;
use Illuminate\Database\Seeder;

class OrganizationProfileSeeder extends Seeder
{
    public function run(): void
    {
        OrganizationProfile::updateOrCreate(
            ['id' => 1],
            [
                'leader_name' => 'Dr. Hj. Siti Aminah, M.Kes.',
                'leader_title' => 'Direktur',
                'leader_position' => 'Kepala PPM Poltekkes Kemenkes Medan',
                'leader_photo' => 'images/leader-photo.jpg',
                'welcome_message' => 'Assalamu\'alaikum Warahmatullahi Wabarakatuh. Selamat datang di website resmi PPM Poltekkes Kemenkes Medan. Kami berkomitmen untuk memberikan pelayanan prima kepada masyarakat dalam bidang kesehatan. Semoga website ini dapat menjadi media informasi yang bermanfaat bagi semua pihak.',
                'organization_structure' => 'images/organization-structure.jpg',
                'main_duties' => '<p>Pusat Penjaminan Mutu bertugas mengoordinasikan, memantau, dan mengevaluasi penyelenggaraan penjaminan mutu di seluruh program studi Poltekkes Kemenkes Medan agar mutu pendidikan vokasi kesehatan memenuhi Standar Nasional Pendidikan Tinggi dan kriteria akreditasi LAM-PTKes.</p>',
                'duties_functions' => '<ul><li>Merancang dan melaksanakan Audit Mutu Internal (AMI) secara periodik beserta tindak lanjutnya.</li><li>Mendampingi program studi dalam penyusunan borang, Laporan Evaluasi Diri, dan visitasi akreditasi.</li><li>Mengelola survei kepuasan mahasiswa, dosen, tenaga kependidikan, alumni, dan pengguna lulusan.</li><li>Menyelenggarakan pelatihan dan sosialisasi budaya mutu bagi civitas akademika.</li><li>Mengelola dokumen mutu (SOP, formulir, rekaman mutu) serta menyusun laporan kinerja mutu periodik.</li></ul>',
            ]
        );
    }
}
