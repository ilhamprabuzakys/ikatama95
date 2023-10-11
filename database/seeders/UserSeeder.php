<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => 'admin',
            'role' => 'admin',
            'email_verified_at' => \now()
        ]);
        User::create([
            'name' => 'Brigjen Pol. Drs. Heri Maryadi, M.M.',
            'username' => 'dayamas',
            'password' => 'dayamas',
            'role' => 'dayamas',
            'email_verified_at' => \now()
        ]);
        User::create([
            'name' => 'Brigjen. Pol. Drs. Edi Swasono, M.M.',
            'username' => 'dayatif',
            'password' => 'dayatif',
            'role' => 'dayatif',
            'dob' => '1969-04-30',
            'email_verified_at' => \now()
        ]);
        User::create([
            'name' => 'Drs. Yuki Ruchimat, M.Si.',
            'username' => 'psm',
            'password' => 'psm',
            'role' => 'psm',
            'email_verified_at' => \now(),
            'keterangan' => 'ASN',
        ]);
    }
}
