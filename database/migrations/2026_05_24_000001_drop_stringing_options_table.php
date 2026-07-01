<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Drop stringing_options table — no longer relevant for CRANKHAUS restaurant
        Schema::dropIfExists('stringing_options');
    }

    public function down(): void
    {
        Schema::create('stringing_options', function (Blueprint $table) {
            $table->id();
            $table->string('nama_senar');
            $table->string('warna_senar')->nullable();
            $table->integer('harga_tambahan')->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }
};
