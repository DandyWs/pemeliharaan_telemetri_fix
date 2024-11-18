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
        Schema::create('setting2s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('simulasi');
            $table->string('display');
            $table->unsignedBigInteger('form_komponen_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting2s');
    }
};
