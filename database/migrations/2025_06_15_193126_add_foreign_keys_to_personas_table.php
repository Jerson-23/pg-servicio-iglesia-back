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
        Schema::table('personas', function (Blueprint $table) {
            $table->foreign(['ministerio_id'], 'fk_personas_ministerios1')->references(['id'])->on('ministerios')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['estado_id'], 'fk_personas_persona_estados1')->references(['id'])->on('persona_estados')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['genero_id'], 'fk_personas_persona_generos1')->references(['id'])->on('persona_generos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['nivel_academico_id'], 'fk_personas_persona_niveles_academicos1')->references(['id'])->on('persona_niveles_academicos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personas', function (Blueprint $table) {
            $table->dropForeign('fk_personas_ministerios1');
            $table->dropForeign('fk_personas_persona_estados1');
            $table->dropForeign('fk_personas_persona_generos1');
            $table->dropForeign('fk_personas_persona_niveles_academicos1');
        });
    }
};
