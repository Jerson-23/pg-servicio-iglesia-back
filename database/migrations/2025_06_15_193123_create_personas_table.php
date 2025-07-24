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
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('primer_nombre', 120);
            $table->string('segundo_nombre', 120)->nullable();
            $table->string('primer_apellido', 120);
            $table->string('segundo_apellido', 120)->nullable();
            $table->string('apellido_casada', 120)->nullable();
            $table->string('telefono', 12);
            $table->string('celular', 12)->nullable();
            $table->text('direccion');
            $table->string('email', 150)->nullable();
            $table->unsignedInteger('ministerio_id')->index('fk_personas_ministerios1_idx');
            $table->unsignedInteger('estado_id')->index('fk_personas_persona_estados1_idx');
            $table->date('fecha_nacimiento')->nullable();
            $table->string('correlativo', 10);
            $table->string('dpi', 13)->nullable();
            $table->unsignedInteger('nivel_academico_id')->index('fk_personas_persona_niveles_academicos1_idx');
            $table->unsignedInteger('genero_id')->index('fk_personas_persona_generos1_idx');
            $table->unsignedInteger('nacionalidad_id')->index('fk_personas_persona_nacionalidad_idx');
            $table->boolean('sabe_leer')->nullable();
            $table->boolean('es_ministro')->nullable();
            $table->boolean('sabe_escribir')->nullable();
            $table->boolean('es_obrero')->nullable();
            $table->enum('estado_civil', [
                'Soltero(a)',
                'Casado(a)',
                'Divorciado(a)',
                'Viudo(a)',
                ]);
            $table->unsignedInteger('conyugue_id')->index('fk_personas_persona_conyugue_idx')->nullable();
            $table->unsignedInteger('profesion_id')->index('fk_personas_persona_profesion_idx')->nullable();
            $table->unsignedInteger('iglesia_id')->index('fk_personas_persona_iglesia_idx')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
