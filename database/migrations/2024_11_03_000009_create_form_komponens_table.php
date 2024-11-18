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
        Schema::create('form_komponens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pemeliharaan2_id');
            $table->unsignedBigInteger('detail_komponen_id');
            $table->boolean('cheked');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_komponens');
    }
};
