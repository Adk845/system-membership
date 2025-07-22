<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        
        $kotas = [
            "Ambon",
            "Balikpapan",
            "Banda Aceh",
            "Bandar Lampung",
            "Bandung",
            "Banjarbaru",
            "Banjarmasin",
            "Batam",
            "Bekasi",
            "Bengkulu",
            "Bogor",
            "Bontang",
            "Bukittinggi",
            "Cilegon",
            "Cirebon",
            "Denpasar",
            "Depok",
            "Gorontalo",
            "Jakarta Barat",
            "Jakarta Pusat",
            "Jakarta Selatan",
            "Jakarta Timur",
            "Jakarta Utara",
            "Jambi",
            "Jayapura",
            "Kediri",
            "Kendari",
            "Kupang",
            "Lhokseumawe",
            "Madiun",
            "Magelang",
            "Makassar",
            "Malang",
            "Manado",
            "Mataram",
            "Medan",
            "Mojokerto",
            "Padang",
            "Palangkaraya",
            "Palembang",
            "Palopo",
            "Palu",
            "Pangkalpinang",
            "Parepare",
            "Pekalongan",
            "Pekanbaru",
            "Pontianak",
            "Probolinggo",
            "Salatiga",
            "Samarinda",
            "Semarang",
            "Serang",
            "Sukabumi",
            "Surabaya",
            "Tangerang",
            "Tanjungpinang",
            "Tarakan",
            "Tasikmalaya",
            "Tegal",
            "Ternate",
            "Yogyakarta"
        ];


         foreach ($kotas as $kota) {
            DB::table('Kota')->insert([
                'nama_kota' => $kota,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
