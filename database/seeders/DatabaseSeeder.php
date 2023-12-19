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
        // User::factory(20)->create();
        $this->call([
            UserSeeder::class,
        ]);

        // // Source data 
        // $surveys = \database_path('sql/surveys.sql');
        // $bakti_photos = \database_path('sql/bakti_photos.sql');
        // $berkarya_photos = \database_path('sql/berkarya_photos.sql');
        // $kolase_album_photos = \database_path('sql/kolase_album_photos.sql');
        // $taruna_photos = \database_path('sql/taruna_photos.sql');

        // try {
        //     // Insert Surveys
        //     DB::unprepared(file_get_contents($surveys));
        //     $maxId = DB::table('surveys')->max('id');
        //     DB::statement("ALTER SEQUENCE surveys_id_seq RESTART WITH " . intval($maxId + 1));

        //     // Insert Bakti Photos
        //     DB::unprepared(file_get_contents($bakti_photos));
        //     $maxId = DB::table('bakti_photos')->max('id');
        //     DB::statement("ALTER SEQUENCE bakti_photos_id_seq RESTART WITH " . intval($maxId + 1));

        //     // Insert Berkarya Photos
        //     DB::unprepared(file_get_contents($berkarya_photos));
        //     $maxId = DB::table('berkarya_photos')->max('id');
        //     DB::statement("ALTER SEQUENCE berkarya_photos_id_seq RESTART WITH " . intval($maxId + 1));

        //     // Insert Kolase Albun Photos
        //     DB::unprepared(file_get_contents($kolase_album_photos));
        //     $maxId = DB::table('kolase_album_photos')->max('id');
        //     DB::statement("ALTER SEQUENCE kolase_album_photos_id_seq RESTART WITH " . intval($maxId + 1));

        //     // Insert Taruna Photos
        //     DB::unprepared(file_get_contents($taruna_photos));
        //     $maxId = DB::table('taruna_photos')->max('id');
        //     DB::statement("ALTER SEQUENCE taruna_photos_id_seq RESTART WITH " . intval($maxId + 1));

        // } catch (\Throwable $th) {
        //     echo "Terjadi kesalahan pada saat import sql data. Pesan kesalahan: " . $th->getMessage();
        // }
    
    }
}
