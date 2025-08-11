<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\Anggota;
use App\Models\User;
use App\Models\UserLama;
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
        


        // $oldUsers = UserLama::all();
        // $oldUsers = UserLama::oldest()->get();
        // $oldUsers = UserLama::orderBy('created_at', 'asc')->get();
        $oldUsers = UserLama::orderByRaw("id = 46 DESC")
                                ->orderBy('created_at', 'asc')
                                ->get();

        foreach($oldUsers as $oldUser){
             $user = User::create([
                    'name' => $oldUser->name,
                    'email' => $oldUser->email,
                    // 'password' => Hash::make('123123123'),
                    'password' => $oldUser->password,
                    'role' => 'member',
                ]);
                $anggota = $user->anggota()->create([
                    'nama' => $oldUser->name,
                    // 'tanggal_lahir' => '2000-01-15',
                    'email' => $oldUser->email,
                    // 'nomor' => '085773897546',
                    'genre' => 'Action,Horor',
                    'domisili' => 'Bekasi',
                ]);

                $anggota->peminatan()->attach([1,2,3]);
                $anggota->bioskop()->attach([1,2]);
        }
       

        //================================

        // //SUPER ADMIN
        // $super_admin = User::create([
        //     'name' => 'Super Admin',
        //     'email' => 'main_admin@gmail.com',
        //     'password' => Hash::make('123123123'),
        //     'role' => 'admin'
        // ]);
        // $main_admin = $super_admin->anggota()->create([
        //     'nama' => 'Super Admin',
        //     'tanggal_lahir' => '2000-01-15',
        //     'domisili' => 'Jakarta Selatan',
        //     'email' => 'main_admin@gmail.com',
        //     'nomor' => '08577384728',
        //     'genre' => 'Horor,Action,Comedy',
        //     'level' => 'koordinator',
        //     'akses_level' => 'koordinator',
        // ]);
        // $main_admin->peminatan()->attach([1,2,3]);
        // $main_admin->bioskop()->attach([1,2,3]);
        // $main_admin->kota()->attach(21);

        //koordinator dummy 

        // $admin = User::create([
        //     'name' => 'Admin Jakarta Selatan',
        //     'email' => 'admin_jaksel@gmail.com',
        //     'password' => Hash::make('123123123'),
        //     'role' => 'koordinator'
        // ]);
        // $admin_anggota = $admin->anggota()->create([
        //     'nama' => 'admin Jakarta selatan',
        //     'tanggal_lahir' => '2000-01-15',
        //     'domisili' => 'Jakarta Selatan',
        //     'email' => 'admin_jaksel@gmail.com',
        //     'nomor' => '08577384728',
        //     'genre' => 'Horor,Action,Comedy,Thriler',
        //     'level' => 'koordinator',
        //     'akses_level' => 'koordinator',
        // ]);
        // $admin_anggota->peminatan()->attach([2]);
        // $admin_anggota->bioskop()->attach([1,2,3]);
        // $admin_anggota->kota()->attach(21);


        //  $kotas = [
        //     '31' => 'Jakarta Selatan',
        //     '18' => 'Bogor',
        //     '12' => 'Bekasi',
        //     '87' => 'Tangerang Selatan',
        //     '25' => 'Depok'];

        // foreach ($kotas as $kota) {
        //     for ($i = 1; $i <= 5; $i++) {
        //         // Membuat user
        //         $user = User::create([
        //             'name' => 'Member ' . $i . ' ' . $kota,
        //             'email' => strtolower(str_replace(' ', '', $kota)) . $i . '@example.com',
        //             'password' => Hash::make('123123123'),
        //             'role' => 'member',
        //         ]);

        //         // Membuat anggota yang berelasi dengan user
        //        $anggota = $user->anggota()->create([
        //             'nama' => 'Anggota ' . $kota . ' ' . $i,
        //             'tanggal_lahir' => '2000-01-15',
        //             'email' => strtolower(str_replace(' ', '', $kota)) . $i . '@example.com',
        //             'nomor' => '085773897546',
        //             'genre' => 'action, horor',
        //             'domisili' => $kota,
        //         ]);
        //         $anggota->peminatan()->attach([1,2,3]);
        //     }
        // }
        
        // GENERATE CUSTOM USER 
        // $emails = [
        //     "ahmad" => 'dirosah.ilmahdi@gmail.com',
        //     "habib" => 'Ha0abdurrahman@gmail.com',
        //     "afif" => 'experimencobacoba@gmail.com'
        // ];

        // $emails = [
        //     [
        //         "nama" => "ahmad",
        //         "email" => "dirosah.ilmahdi@gmail.com",
        //         "peminatan" => 1
        //     ],
        //     [
        //         "nama" => "habib",
        //         "email" => "ha0abdurrahman@gmail.com",
        //         "peminatan" => 2
        //     ],
        //     [
        //         "nama" => "afif",
        //         "email" => "experimencobacoba@gmail.com",
        //         "peminatan" => 3
        //     ]
                            
        // ];

        // foreach($emails as $item){

        //      $admin = User::create([
        //     'name' => $item["nama"],
        //     'email' => $item["email"],
        //     'password' => Hash::make('123123123'),
        //     'role' => 'member'
        // ]);
        // $admin_anggota = $admin->anggota()->create([
        //     'nama' => $item["nama"],
        //     'tanggal_lahir' => '2000-01-15',
        //     'domisili' => 'Jakarta Selatan',
        //     'email' => $item["email"],
        //     'nomor' => '08577384728',
        //     'genre' => 'Horor,Action,Comedy,Thriler',
        //     'level' => 'member',
        //     'akses_level' => 'member',
        // ]);
        // $admin_anggota->peminatan()->attach($item["peminatan"]);
        // $admin_anggota->bioskop()->attach([1,2,3]);
        // $admin_anggota->kota()->attach(21);
        // }
    }
}
