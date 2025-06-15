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
        Schema::table('bautiso_bitacoras', function (Blueprint $table) {
            $table->foreign(['bautiso_id'], 'fk_bautiso_bitacoras_bautisos')->references(['id'])->on('bautisos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['user_registra_id'], 'fk_bautiso_bitacoras_users1')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bautiso_bitacoras', function (Blueprint $table) {
            $table->dropForeign('fk_bautiso_bitacoras_bautisos');
            $table->dropForeign('fk_bautiso_bitacoras_users1');
        });
    }
};
