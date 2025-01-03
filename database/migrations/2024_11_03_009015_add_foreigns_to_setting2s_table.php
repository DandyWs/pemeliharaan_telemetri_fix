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
        Schema::table('setting2s', function (Blueprint $table) {
            $table
                ->foreign('pemeliharaan2_id')
                ->references('id')
                ->on('pemeliharaan2s')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('setting2s', function (Blueprint $table) {
            $table->dropForeign(['pemeliharaan2_id']);
        });
    }
};
