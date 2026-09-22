<?php

namespace Database\Seeders;

use App\Models\Personnel;
use Illuminate\Database\Seeder;

class PersonnelSeeder extends Seeder
{
    public function run(): void
    {
        $personnels = [
            [
                'name' => 'Bdn. Tiyara Safitri, S.Si.T., M.Tr.Keb',
                'position' => 'PJ. SPMI dan SPME',
                'nip' => '199010262025062001',
                'photo' => 'images/personnels/personnel-1.png',
                'sort_order' => 1,
            ],
            [
                'name' => 'Rus Andriani, A.Kp., MPH',
                'position' => 'Koor. Mutu DIII Kep dan PJJ DIII Kep',
                'nip' => '197102061995032001',
                'photo' => 'images/personnels/personnel-2.png',
                'sort_order' => 2,
            ],
            [
                'name' => 'Ns. Arifin Hidayat, M.Kes',
                'position' => 'Koor. Mutu DIV Kep dan Profesi Ners',
                'nip' => '199112242023211013',
                'photo' => 'images/personnels/personnel-3.png',
                'sort_order' => 3,
            ],
        ];

        foreach ($personnels as $p) {
            Personnel::create($p);
        }
    }
}
