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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nip');
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->text('alamat');
            $table->text('tgl_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->bigInteger('golongan_id');
            $table->bigInteger('eselon_id');
            $table->bigInteger('jabatan_id');
            $table->string('tempat_tugas');
            $table->bigInteger('agama_id');
            $table->bigInteger('unit_kerja_id')->nullable();
            $table->bigInteger('no_hp')->nullable();
            $table->string('npwp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
