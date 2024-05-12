<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => "Super Administrator",
                'email' => "admin@local.com", // kolom level harusnya udah ga ada
                'username' => "admin",
                'password' => Hash::make('12345'),
                'id_role' => 1
            ]
        ]);
    }
}
