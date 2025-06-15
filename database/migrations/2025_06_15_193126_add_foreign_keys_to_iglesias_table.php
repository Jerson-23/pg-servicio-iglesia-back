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
        Schema::table('iglesias', function (Blueprint $table) {
            $table->foreign(['pastor_id'], 'fk_iglesias_users1')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('iglesias', function (Blueprint $table) {
            $table->dropForeign('fk_iglesias_users1');
        });
    }
};
