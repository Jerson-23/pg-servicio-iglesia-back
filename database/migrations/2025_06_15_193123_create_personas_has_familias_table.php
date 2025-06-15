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
        Schema::create('personas_has_familias', function (Blueprint $table) {
            $table->unsignedInteger('personas_id')->index('fk_personas_has_familias_personas1_idx');
            $table->unsignedInteger('familias_id')->index('fk_personas_has_familias_familias1_idx');
            $table->unsignedInteger('familia_tipos_id')->index('fk_personas_has_familias_familia_tipos1_idx');

            $table->primary(['personas_id', 'familias_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas_has_familias');
    }
};
