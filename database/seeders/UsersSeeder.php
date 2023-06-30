<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'nama' => 'Admin',
			'email' => 'admin@gmail.com',
			'password' => bcrypt('admin'),
			'role' => 'admin',
            'no_hp' => '087899144407',
            'jenis_kelamin' => 'perempuan'
        ]);

        DB::table('users')->insert([
            'nama' => 'Nadia Nur Saida',
			'email' => 'nadianrs88@gmail.com',
			'password' => bcrypt('nadia'),
			'role' => 'customer',
            'no_hp' => '087899144407',
            'jenis_kelamin' => 'perempuan'
        ]);
    }
}
