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
        Schema::create('bautisos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('observaciones');
            $table->dateTime('fecha_bautiso');
            $table->time('hora_bautiso');
            $table->unsignedInteger('persona_id')->index('fk_bautisos_personas1_idx');
            $table->unsignedBigInteger('user_registra_id')->index('fk_bautisos_users1_idx');
            $table->unsignedInteger('iglesia_id')->index('fk_bautisos_iglesias1_idx');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bautisos');
    }
};
