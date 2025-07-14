<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\Anggota;
use App\Models\User;
use App\Models\Kota;
use App\Models\Bioskop;
use App\Models\Peminatan;

class UserAnggota extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //SUPER ADMIN
        $super_admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123123123'),
            'role' => 'admin'
        ]);
        $admin_anggota = $super_admin->anggota()->create([
            'nama' => 'Super Admin',
            'tanggal_lahir' => '2000-01-15',
            'domisili' => 'Jakarta Selatan',
            'email' => 'admin@gmail.com',
            'nomor' => '08577384728',
            'genre' => 'horor,action,comedy',
            'level' => 'koordinator',
            'akses_level' => 'koordinator',
        ]);

        //koordinator dummy 

        $admin = User::create([
            'name' => 'Admin Jakarta Selatan',
            'email' => 'admin_jaksel@gmail.com',
            'password' => Hash::make('123123123'),
            'role' => 'koordinator'
        ]);
        $admin_anggota = $admin->anggota()->create([
            'nama' => 'admin Jakarta selatan',
            'tanggal_lahir' => '2000-01-15',
            'domisili' => 'Jakarta Selatan',
            'email' => 'admin_jaksel@gmail.com',
            'nomor' => '08577384728',
            'genre' => 'horor,action,comedy,thriler',
            'level' => 'koordinator',
            'akses_level' => 'koordinator',
        ]);

        $admin_anggota->kota()->attach(31);

        $kotas = [
            '31' => 'Jakarta Selatan',
            '18' => 'Bogor',
            '12' => 'Bekasi',
            '87' => 'Tangerang Selatan',
            '25' => 'Depok'];

        foreach ($kotas as $kota) {
            for ($i = 1; $i <= 5; $i++) {
                // Membuat user
                $user = User::create([
                    'name' => 'Member ' . $i . ' ' . $kota,
                    'email' => strtolower(str_replace(' ', '', $kota)) . $i . '@example.com',
                    'password' => Hash::make('123123123'),
                    'role' => 'member',
                ]);

                // Membuat anggota yang berelasi dengan user
               $anggota = $user->anggota()->create([
                    'nama' => 'Anggota ' . $kota . ' ' . $i,
                    'tanggal_lahir' => '2000-01-15',
                    'email' => strtolower(str_replace(' ', '', $kota)) . $i . '@example.com',
                    'nomor' => '085773897546',
                    'genre' => 'action, horor',
                    'domisili' => $kota,
                ]);
                $anggota->peminatan()->attach([1,2,3]);
            }
        }
    }
}
