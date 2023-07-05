<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;


class TransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('transactions')->insert([
        //     'id_user' => '2',
        //     'id_kamar' => '19',
		// 	'total_harga' => '375000',
		// 	'status' => 'booking',
		// 	'check_in_at' => Carbon::parse('2023-06-01 09:30:00'),
        //     'check_out_at' => Carbon::parse('2023-06-02 09:30:00'),
		// 	'lama_penginapan' => '1',
        // ]);

        // DB::table('transactions')->insert([
        //     'id_user' => '2',
        //     'id_kamar' => '18',
		// 	'total_harga' => '441000',
		// 	'status' => 'booking',
		// 	'check_in_at' => Carbon::parse('2023-07-01 09:30:00'),
        //     'check_out_at' => Carbon::parse('2023-07-04 09:30:00'),
		// 	'lama_penginapan' => '3',
        // ]);
    }
}
