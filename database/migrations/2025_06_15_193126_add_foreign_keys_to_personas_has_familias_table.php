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
        Schema::table('personas_has_familias', function (Blueprint $table) {
            $table->foreign(['familia_tipos_id'], 'fk_personas_has_familias_familia_tipos1')->references(['id'])->on('familia_tipos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['familias_id'], 'fk_personas_has_familias_familias1')->references(['id'])->on('familias')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['personas_id'], 'fk_personas_has_familias_personas1')->references(['id'])->on('personas')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personas_has_familias', function (Blueprint $table) {
            $table->dropForeign('fk_personas_has_familias_familia_tipos1');
            $table->dropForeign('fk_personas_has_familias_familias1');
            $table->dropForeign('fk_personas_has_familias_personas1');
        });
    }
};
