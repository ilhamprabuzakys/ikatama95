<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(20)->create();
        $this->call([
            UserSeeder::class,
        ]);

        $surveys = \database_path('sql/surveys.sql');
        try {
            DB::unprepared(file_get_contents($surveys));
        } catch (\Throwable $th) {
            echo "Terjadi kesalahan pada saat import sql data. Pesan kesalahan: " . $th->getMessage();
        }

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
