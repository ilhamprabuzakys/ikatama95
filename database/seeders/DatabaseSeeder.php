<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
        ]);

        /* $satker = resource_path('../importable/satker.sql');
        $users = resource_path('../importable/data_users.sql');
        $relawan = resource_path('../importable/relawan.sql');
        $laporan = resource_path('../importable/laporan.sql');
        $laporan_log = resource_path('../importable/laporan_log.sql');

        try {
            DB::unprepared(file_get_contents($satker));
            DB::unprepared(file_get_contents($relawan));
        } catch (\Throwable $th) {
            echo "Terjadi kesalahan pada file: {$satker}. Pesan kesalahan: " . $th->getMessage();
        } */

        // DB::unprepared(
        //     file_get_contents($regencies)
        // );
        // DB::unprepared(
        //     file_get_contents($laporan)
        // );
        // DB::unprepared(
        //     file_get_contents($laporan_log)
        // );
    }
}
