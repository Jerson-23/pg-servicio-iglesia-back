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
        Schema::create('bautiso_bitacoras', function (Blueprint $table) {
            $table->increments('id');
            $table->text('descripcion');
            $table->dateTime('fecha_registro')->nullable();
            $table->unsignedInteger('bautiso_id')->index('fk_bautiso_bitacoras_bautisos_idx');
            $table->unsignedBigInteger('user_registra_id')->index('fk_bautiso_bitacoras_users1_idx');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bautiso_bitacoras');
    }
};
