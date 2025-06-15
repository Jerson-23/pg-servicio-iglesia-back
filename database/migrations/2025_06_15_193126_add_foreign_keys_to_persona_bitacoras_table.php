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
        Schema::table('persona_bitacoras', function (Blueprint $table) {
            $table->foreign(['persona_id'], 'fk_persona_bitacoras_personas1')->references(['id'])->on('personas')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['user_registra_id'], 'fk_persona_bitacoras_users1')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('persona_bitacoras', function (Blueprint $table) {
            $table->dropForeign('fk_persona_bitacoras_personas1');
            $table->dropForeign('fk_persona_bitacoras_users1');
        });
    }
};
