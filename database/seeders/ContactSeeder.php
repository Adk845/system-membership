<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $data = [
        [
            'name' => 'ahmad',
            'company' => 'PT Shopee Indonesia',
            'email' => 'dirosah.ilmahdi@gmail.com',
            'address' => 'Jl. Kemerdekaan no.05',
            'notes' => 'test crm',
            'phone' => '085773892545',
            'website' => 'hive.isolutions.co.id',
        ],
        [
            'name' => 'ahmad',
            'company' => 'PT Shopee Indonesia',
            'email' => 'ha0abdurrahman@gmail.com',
            'address' => 'Jl. Kemerdekaan no.05',
            'notes' => 'test crm',
            'phone' => '085773892545',
            'website' => 'hive.isolutions.co.id',
        ],
        [
            'name' => 'ahmad',
            'company' => 'PT Shopee Indonesia',
            'email' => 'experimencobacoba@gmail.com',
            'address' => 'Jl. Kemerdekaan no.05',
            'notes' => 'test crm',
            'phone' => '085773892545',
            'website' => 'hive.isolutions.co.id',
        ],
    ];
    }
}
