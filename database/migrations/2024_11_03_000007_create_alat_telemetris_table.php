<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alat_telemetris', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lokasiStasiun');
            $table->unsignedBigInteger('jenis_alat_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alat_telemetris');
    }
};
