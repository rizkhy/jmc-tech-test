<?php

namespace Database\Seeders;

use App\Models\Resdient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ResdientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Resdient::truncate();

        $data = [
            [
                'name' => 'John Doe',
                'id_number' => '12345',
                'gender' => 'Laki-Laki',
                'date_of_birth' => '1990-01-01',
                'address' => 'Jl. Lorem Ipsum Dolor Sit Amet',
                'city_id' => 1,
                'province_id' => 1,
            ],
            [
                'name' => 'Jane Doe',
                'id_number' => '12346',
                'gender' => 'Perempuan',
                'date_of_birth' => '1991-01-01',
                'address' => 'Jl. Lorem Ipsum Dolor Sit Amet',
                'city_id' => 2,
                'province_id' => 1,
            ],
            [
                'name' => 'Jeki Doe',
                'id_number' => '12347',
                'gender' => 'Perempuan',
                'date_of_birth' => '1992-01-01',
                'address' => 'Jl. Lorem Ipsum Dolor Sit Amet',
                'city_id' => 3,
                'province_id' => 1,
            ]
        ];

        Resdient::insert($data);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
