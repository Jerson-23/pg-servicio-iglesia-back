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
        Schema::create('eventos_has_personas', function (Blueprint $table) {
            $table->unsignedInteger('eventos_id')->index('fk_eventos_has_personas_eventos1_idx');
            $table->unsignedInteger('personas_id')->index('fk_eventos_has_personas_personas1_idx');

            $table->primary(['eventos_id', 'personas_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos_has_personas');
    }
};
