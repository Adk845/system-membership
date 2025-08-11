<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Peminatan;

class PeminatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $data = [
            ['peminatan' => 'nonton'],
            ['peminatan' => 'training development'],
            ['peminatan' => 'seminar'],
        ];

        Peminatan::insert($data);
    }
}
