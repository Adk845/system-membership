<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Ambil anggota admin (misal berdasarkan email)
        $admin_anggota = \App\Models\Anggota::where('email', 'admin_jaksel@gmail.com')->first();

        if (!$admin_anggota) {
            $this->command->error('Admin anggota tidak ditemukan!');
            return;
        }

        $events = [
            [
                'anggota_id' => $admin_anggota->id,
                'createdBy' => 'Admin Jakarta Selatan',
                'nama' => 'Seminar Digital Marketing',
                'deskripsi' => 'Seminar membahas strategi digital marketing modern.',
                'narasumber' => 'Budi Santoso',
                'jenis_peminatan' => 'Seminar',
                'Lokasi' => 'Jakarta Selatan',
                'link' => 'https://event1.com',
                'tanggal' => '2025-08-01',
                'waktu' => '09:00:00',
                'wilayah_koordinator' => 'Jakarta Selatan',
                'gambar' => 'event1.jpg',
            ],
            [
                'anggota_id' => $admin_anggota->id,
                'createdBy' => 'Admin Jakarta Selatan',
                'nama' => 'Workshop UI/UX',
                'deskripsi' => 'Workshop desain UI/UX untuk pemula.',
                'narasumber' => 'Siti Aminah',
                'jenis_peminatan' => 'Workshop',
                'Lokasi' => 'Jakarta Selatan',
                'link' => 'https://event2.com',
                'tanggal' => '2025-08-05',
                'waktu' => '13:30:00',
                'wilayah_koordinator' => 'Jakarta Selatan',
                'gambar' => 'event2.jpg',
            ],
            [
                'anggota_id' => $admin_anggota->id,
                'createdBy' => 'Admin Jakarta Selatan',
                'nama' => 'Nonton Bareng Film Edukasi',
                'deskripsi' => 'Acara nonton bareng film edukasi dan diskusi.',
                'narasumber' => 'Andi Wijaya',
                'jenis_peminatan' => 'Nonton',
                'Lokasi' => 'Bioskop XXI Blok M',
                'link' => 'https://event3.com',
                'tanggal' => '2025-08-10',
                'waktu' => '18:00:00',
                'wilayah_koordinator' => 'Jakarta Selatan',
                'gambar' => 'event3.jpg',
            ],
            [
                'anggota_id' => $admin_anggota->id,
                'createdBy' => 'Admin Jakarta Selatan',
                'nama' => 'Seminar Berbayar Bisnis Online',
                'deskripsi' => 'Seminar berbayar tentang bisnis online.',
                'narasumber' => 'Rina Dewi',
                'jenis_peminatan' => 'Seminar Berbayar',
                'Lokasi' => 'Hotel Grand Jakarta',
                'link' => 'https://event4.com',
                'tanggal' => '2025-08-15',
                'waktu' => '10:00:00',
                'wilayah_koordinator' => 'Jakarta Selatan',
                'gambar' => 'event4.jpg',
            ],
            [
                'anggota_id' => $admin_anggota->id,
                'createdBy' => 'Admin Jakarta Selatan',
                'nama' => 'Pelatihan Public Speaking',
                'deskripsi' => 'Pelatihan untuk meningkatkan kemampuan public speaking.',
                'narasumber' => 'Dewi Lestari',
                'jenis_peminatan' => 'Pelatihan',
                'Lokasi' => 'Gedung Serbaguna',
                'link' => 'https://event5.com',
                'tanggal' => '2025-08-20',
                'waktu' => '15:00:00',
                'wilayah_koordinator' => 'Jakarta Selatan',
                'gambar' => 'event5.jpg',
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
