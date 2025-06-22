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
        Schema::table('eventos', function (Blueprint $table) {
            $table->foreign(['tipo_id'], 'fk_eventos_evento_tipos1')->references(['id'])->on('evento_tipos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['iglesia_id'], 'fk_eventos_iglesias1')->references(['id'])->on('iglesias')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eventos', function (Blueprint $table) {
            $table->dropForeign('fk_eventos_evento_tipos1');
            $table->dropForeign('fk_eventos_iglesias1');
        });
    }
};
