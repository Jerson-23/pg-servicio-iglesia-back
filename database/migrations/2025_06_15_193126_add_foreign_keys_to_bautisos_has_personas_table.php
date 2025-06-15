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
        Schema::table('bautisos_has_personas', function (Blueprint $table) {
            $table->foreign(['bautisos_id'], 'fk_bautisos_has_personas_bautisos1')->references(['id'])->on('bautisos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['personas_id'], 'fk_bautisos_has_personas_personas1')->references(['id'])->on('personas')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bautisos_has_personas', function (Blueprint $table) {
            $table->dropForeign('fk_bautisos_has_personas_bautisos1');
            $table->dropForeign('fk_bautisos_has_personas_personas1');
        });
    }
};
