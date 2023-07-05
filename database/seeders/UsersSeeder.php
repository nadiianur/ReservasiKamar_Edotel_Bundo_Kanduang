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
			'password' => bcrypt('nadianrs88'),
			'role' => 'customer',
            'no_hp' => '087899144407',
            'jenis_kelamin' => 'perempuan'
        ]);

        DB::table('users')->insert([
            'nama' => 'Customer 1',
			'email' => 'customer1@gmail.com',
			'password' => bcrypt('customer1'),
			'role' => 'customer',
            'no_hp' => '087908342144',
            'jenis_kelamin' => 'laki-laki'
        ]);

        DB::table('users')->insert([
            'nama' => 'Customer 2',
			'email' => 'customer2@gmail.com',
			'password' => bcrypt('customer2'),
			'role' => 'customer',
            'no_hp' => '081344323408',
            'jenis_kelamin' => 'perempuan'
        ]);

        DB::table('users')->insert([
            'nama' => 'Customer 3',
			'email' => 'customer3@gmail.com',
			'password' => bcrypt('customer3'),
			'role' => 'customer',
            'no_hp' => '085268437408',
            'jenis_kelamin' => 'laki-laki'
        ]);

        DB::table('users')->insert([
            'nama' => 'Customer 4',
			'email' => 'customer4@gmail.com',
			'password' => bcrypt('customer4'),
			'role' => 'customer',
            'no_hp' => '087893427788',
            'jenis_kelamin' => 'laki-laki'
        ]);

        DB::table('users')->insert([
            'nama' => 'Customer 5',
			'email' => 'customer5@gmail.com',
			'password' => bcrypt('customer5'),
			'role' => 'customer',
            'no_hp' => '081356799442',
            'jenis_kelamin' => 'perempuan'
        ]);
    }
}
