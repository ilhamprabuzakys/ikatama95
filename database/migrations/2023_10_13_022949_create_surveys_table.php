<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('nama');
            $table->string('panggilan');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('pangkat');
            $table->string('nrp');
            $table->string('status_kedinasan');
            $table->string('status_pernikahan');
            $table->bigInteger('jumlah_anak')->nullable();
            $table->string('no_telepon');
            $table->string('email');
            $table->text('alamat');
            $table->text('motto');
            $table->text('foto_terkini')->nullable();
            $table->text('narasi_personal');
            $table->text('foto_keluarga')->nullable();
            $table->text('narasi_keluarga');

            for ($i = 1; $i <= 5; $i++) {
                
                $anak_index = match ($i) {
                    1 => 'pertama',
                    2 => 'kedua',
                    3 => 'ketiga',
                    4 => 'keempat',
                    5 => 'kelima',
                };


                $table->text('foto_anak_' . $anak_index)->nullable();
                $table->string('nama_anak_' . $anak_index)->nullable();
                $table->string('tempat_lahir_anak_' . $anak_index)->nullable();
                $table->date('tanggal_lahir_anak_' . $anak_index)->nullable();
                $table->string('jenis_kelamin_anak_' . $anak_index)->nullable();
                $table->string('pekerjaan_anak_' . $anak_index)->nullable();
                $table->text('alamat_anak_' . $anak_index)->nullable();
                $table->text('motto_anak_' . $anak_index)->nullable();
            }

            $table->timestamps();

            // Relasi ke tabel lain
            // $table->unsignedBigInteger('taruna_photo_id')->nullable();
            // $table->unsignedBigInteger('bakti_photo_id')->nullable();
            // $table->unsignedBigInteger('berkarya_photo_id')->nullable();
            
            // // Foreign keys
            // $table->foreign('taruna_photo_id')->references('id')->on('taruna_photos')->onDelete('cascade');
            // $table->foreign('bakti_photo_id')->references('id')->on('bakti_photos')->onDelete('cascade');
            // $table->foreign('berkarya_photo_id')->references('id')->on('berkarya_photos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
