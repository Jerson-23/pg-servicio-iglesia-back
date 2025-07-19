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
        Schema::table('bautisos', function (Blueprint $table) {
            $table->foreign(['iglesia_id'], 'fk_bautisos_iglesias1')->references(['id'])->on('iglesias')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['persona_id'], 'fk_bautisos_personas1')->references(['id'])->on('personas')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['user_registra_id'], 'fk_bautisos_users1')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['ministro_id'], 'fk_bautisos_users2')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bautisos', function (Blueprint $table) {
            $table->dropForeign('fk_bautisos_iglesias1');
            $table->dropForeign('fk_bautisos_personas1');
            $table->dropForeign('fk_bautisos_users1');
            $table->dropForeign('fk_bautisos_users2');
        });
    }
};
