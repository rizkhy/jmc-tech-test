<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        City::truncate();

        $data = [
            ['province_code' => 11, 'code' => '1101', 'name' => 'KABUPATEN SIMEULUE'],
            ['province_code' => 11, 'code' => '1102', 'name' => 'KABUPATEN ACEH SINGKIL'],
            ['province_code' => 11, 'code' => '1103', 'name' => 'KABUPATEN ACEH SELATAN'],
            ['province_code' => 11, 'code' => '1104', 'name' => 'KABUPATEN ACEH TENGGARA'],
            ['province_code' => 11, 'code' => '1105', 'name' => 'KABUPATEN ACEH TIMUR'],
            ['province_code' => 11, 'code' => '1106', 'name' => 'KABUPATEN ACEH TENGAH'],
            ['province_code' => 11, 'code' => '1107', 'name' => 'KABUPATEN ACEH BARAT'],
            ['province_code' => 11, 'code' => '1108', 'name' => 'KABUPATEN ACEH BESAR'],
            ['province_code' => 11, 'code' => '1109', 'name' => 'KABUPATEN PIDIE'],
            ['province_code' => 11, 'code' => '1110', 'name' => 'KABUPATEN BIREUEN'],
            ['province_code' => 11, 'code' => '1111', 'name' => 'KABUPATEN ACEH UTARA'],
            ['province_code' => 11, 'code' => '1112', 'name' => 'KABUPATEN ACEH BARAT DAYA'],
            ['province_code' => 11, 'code' => '1113', 'name' => 'KABUPATEN GAYO LUES'],
            ['province_code' => 11, 'code' => '1114', 'name' => 'KABUPATEN ACEH TAMIANG'],
            ['province_code' => 11, 'code' => '1115', 'name' => 'KABUPATEN NAGAN RAYA'],
        ];

        City::insert($data);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
