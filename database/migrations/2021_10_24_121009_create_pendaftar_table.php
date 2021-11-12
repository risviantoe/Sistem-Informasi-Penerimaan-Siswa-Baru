<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('nama');
            $table->string('asal_sekolah');
            $table->string('jurusan_pilihan');
            $table->float('nilai_bind');
            $table->float('nilai_mtk');
            $table->float('nilai_ipa');
            $table->float('nilai_bing');
            $table->float('rata_rata');
            $table->string('status')->default('Proses Seleksi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftar');
    }
}
