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
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('username')->unique();
            $table->string('nohp')->unique();
            $table->string('nik');
            $table->string('area');
            $table->string('role');
            $table->string('jabatan');
            $table->string('level');
            $table->string('password');
            $table->string('alamat');
            $table->string('status');
            $table->string('name_pasangan')->nullable();
            $table->string('name_anak')->nullable();
            $table->string('golongan_darah')->nullable();
            $table->string('kta')->nullable();
            $table->string('agama');
            $table->string('jenis_kelamin');
            $table->string('ktp');
            $table->string('skck')->nullable();
            $table->string('lamaran')->nullable();
            $table->string('foto')->nullable();
            $table->string('file_foto')->nullable();
            $table->string('surat_sehat')->nullable();
            $table->string('ijazah')->nullable();
            $table->string('kk');
            $table->string('izin_ortu')->nullable();
            $table->string('paklaring')->nullable();
            $table->string('sim')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
