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
        Schema::create('layanan', function (Blueprint $table) {
            $table->integer('id_layanan')->primary();
            $table->integer('id_subkategori');
            $table->string('bandwidth');
            $table->string('satuan');
            $table->decimal('harga', 20, 0);
        
            $table->foreign('id_subkategori')->references('id_subkategori')->on('subkategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};
