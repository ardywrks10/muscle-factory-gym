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
        Schema::create('tb_transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('kelas_id');
            $table->foreign('member_id')->references('id')->on('tb_members');
            $table->foreign('kelas_id')->references('id')->on('tb_kelas');
            $table->date('tgl_transaksi');
            $table->integer('jumlah_bulan'); 
            $table->decimal('total_bayar', 10, 2); 
            $table->decimal('uang_diterima', 10, 2); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_transaksi');
    }
};
