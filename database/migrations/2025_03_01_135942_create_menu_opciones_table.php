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
        Schema::create('menu_opciones', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('titulo')->nullable();
            $table->string('titulo_seccion')->nullable();
            $table->string('icono')->nullable();
            $table->string('ruta')->nullable();
            $table->integer('orden')->nullable()->default(0);
            $table->string('action');
            $table->string('subject');

            $table->bigInteger('parent_id')
                ->unsigned()
                ->nullable()
                ->index('fk_parent_parents1_idx')
                ->comment('opcion padre');

            $table->foreign('parent_id', 'fk_parents1')
                ->references('id')
                ->on('menu_opciones')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_opciones');
    }
};
