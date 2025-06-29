<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WilayahKoordinatorSeeder extends Seeder
{
    public function run(): void
    {
        $kotas = [
            'Ambon', 'Balikpapan', 'Banda Aceh', 'Bandar Lampung', 'Bandung', 'Banjar', 'Banjarbaru', 'Banjarmasin',
            'Batam', 'Batu', 'Baubau', 'Bekasi', 'Bengkulu', 'Bima', 'Binjai', 'Bitung', 'Blitar', 'Bogor',
            'Bontang', 'Bukittinggi', 'Cilegon', 'Cimahi', 'Cirebon', 'Denpasar', 'Depok', 'Dumai', 'Gorontalo',
            'Gunungsitoli', 'Jakarta Barat', 'Jakarta Pusat', 'Jakarta Selatan', 'Jakarta Timur', 'Jakarta Utara',
            'Jambi', 'Jayapura', 'Kediri', 'Kendari', 'Kotamobagu', 'Kupang', 'Langsa', 'Lhokseumawe', 'Lubuklinggau',
            'Madiun', 'Magelang', 'Makassar', 'Malang', 'Manado', 'Mataram', 'Medan', 'Metro', 'Mojokerto',
            'Padang', 'Padang Panjang', 'Padangsidimpuan', 'Pagar Alam', 'Palangkaraya', 'Palembang', 'Palopo',
            'Palu', 'Pangkalpinang', 'Parepare', 'Pariaman', 'Pasuruan', 'Payakumbuh', 'Pekalongan', 'Pekanbaru',
            'Pematangsiantar', 'Pontianak', 'Prabumulih', 'Probolinggo', 'Sabang', 'Salatiga', 'Samarinda',
            'Sawahlunto', 'Semarang', 'Serang', 'Sibolga', 'Singkawang', 'Solok', 'Sorong', 'Subulussalam',
            'Sukabumi', 'Sungai Penuh', 'Surabaya', 'Surakarta', 'Tangerang', 'Tangerang Selatan', 'Tanjungbalai',
            'Tanjungpinang', 'Tarakan', 'Tasikmalaya', 'Tebing Tinggi', 'Tegal', 'Ternate', 'Tidore Kepulauan',
            'Tomohon', 'Tual', 'Yogyakarta'
        ];

        foreach ($kotas as $kota) {
            DB::table('wilayah_koordinator')->insert([
                'wilayah' => $kota,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
