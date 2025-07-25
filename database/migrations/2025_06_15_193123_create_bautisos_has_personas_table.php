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
        Schema::create('bautisos_has_personas', function (Blueprint $table) {
            $table->unsignedInteger('bautisos_id')->index('fk_bautisos_has_personas_bautisos1_idx');
            $table->unsignedInteger('personas_id')->index('fk_bautisos_has_personas_personas1_idx');

            $table->primary(['bautisos_id', 'personas_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bautisos_has_personas');
    }
};
