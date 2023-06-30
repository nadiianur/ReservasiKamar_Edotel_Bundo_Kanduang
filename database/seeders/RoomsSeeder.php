<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rooms')->insert([
            'no_kamar' => '101',
            'tipe_kamar' => 'single room',
			'harga' => '127000',
			'status' => 'ready',
			'kapasitas' => '1',
        ]);

        DB::table('rooms')->insert([
            'no_kamar' => '201',
            'tipe_kamar' => 'family room',
			'harga' => '450000',
			'status' => 'ready',
			'kapasitas' => '5',
        ]);

        DB::table('rooms')->insert([
            'no_kamar' => '202',
            'tipe_kamar' => 'family room',
			'harga' => '450000',
			'status' => 'ready',
			'kapasitas' => '5',
        ]);

        DB::table('rooms')->insert([
            'no_kamar' => '106',
            'tipe_kamar' => 'double room',
			'harga' => '310000',
			'status' => 'ready',
			'kapasitas' => '2',
        ]);
    }
}
