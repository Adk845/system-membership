<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bioskop;
use App\Models\Kota;

class BioskopSeeder extends Seeder
{
    public function run()
    {
        $wilayahs = [
            'Jakarta Selatan' => [
                'CGV Pacific Place',
                'CGV Poins Mall',
                'Gandaria City XXI',
                'Epicentrum XXI',
                'Pondok Indah 2 XXI',
            ],
            'Jakarta Timur' => [
                'CGV Buaran Plaza',
                'CGV AEON Mall JGC',
                'Cinema XXI Arion',
                'Buaran Plaza XXI',
                'CGV Metropolitan Mall Cakung',
            ],
            'Jakarta Barat' => [
                'CGV Central Park',
                'CGV Taman Anggrek',
                'Bijou Cinema Citraland',
                'Cinema XXI Puri Indah Mall',
                'XXI Palm Palace',
            ],
            'Jakarta Utara' => [
                'CGV Baywalk Pluit',
                'CGV Emporium Pluit Mall',
                'Cinema XXI Pluit Village',
                'CGV Mall Of Indonesia',
                'Cinema XXI Kelapa Gading',
            ],
            'Jakarta Pusat' => [
                'CGV Grand Indonesia',
                'Metropole XXI',
                'Menteng Cinema',
                'CGV Plaza Indonesia',
                'Cinema XXI Sarinah',
            ],
            'Bogor' => [
                'AEON Mall Sentul City XXI',
                'Botani Square XXI',
                'Bogor Trade Mall XXI',
                'Cibinong City XXI',
                'Living World Kota Wisata XXI',
            ],
            'Bekasi' => [
                'CGV Bekasi Cyber Park',
                'CGV Lagoon Avenue',
                'CGV Summarecon Mall Bekasi',
                'XXI Grand Galaxy Park',
                'Cinema XXI Bekasi Junction',
            ],
        ];

        foreach ($wilayahs as $namaWilayah => $bioskops) {
            // Ambil instance WilayahBioskop
            $kota = Kota::where('nama_kota', $namaWilayah)->first();

            if (!$kota) {
                // Lewatkan jika kota tidak ditemukan
                continue;
            }

            foreach ($bioskops as $name) {
                // Hindari duplikat bioskop di kota yang sama
                Bioskop::firstOrCreate([
                    'bioskop' => $name,
                    'kota_id' => $kota->id,
                ]);
            }
        }
    }
}
