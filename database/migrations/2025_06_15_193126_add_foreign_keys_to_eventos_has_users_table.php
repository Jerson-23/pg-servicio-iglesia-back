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
        Schema::table('eventos_has_users', function (Blueprint $table) {
            $table->foreign(['eventos_id'], 'fk_eventos_has_users_eventos1')->references(['id'])->on('eventos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['users_id'], 'fk_eventos_has_users_users1')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eventos_has_users', function (Blueprint $table) {
            $table->dropForeign('fk_eventos_has_users_eventos1');
            $table->dropForeign('fk_eventos_has_users_users1');
        });
    }
};
