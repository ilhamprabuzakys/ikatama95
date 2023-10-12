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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('username')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'alumni']);
            // Additional
            $table->text('avatar')->default('assets/images/avatar/avatar-' . random_int(1,5) .'.png');
            $table->string('nik')->nullable();
            $table->string('nip')->nullable();
            $table->string('keterangan')->nullable();
            $table->date('dob')->nullable();
            $table->string('pob')->nullable();
            $table->text('address')->nullable();
            $table->string('phone', 15)->nullable();
            $table->enum('gender', ['L', 'P'])->nullable();
            $table->boolean('is_online')->default(false);
            $table->boolean('is_active')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
