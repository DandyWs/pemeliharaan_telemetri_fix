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
        Schema::table('detail_komponens', function (Blueprint $table) {
            $table
                ->foreign('komponen2_id')
                ->references('id')
                ->on('komponen2s')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_komponens', function (Blueprint $table) {
            $table->dropForeign(['komponen2_id']);
        });
    }
};
