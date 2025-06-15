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
        Schema::table('bautisos_has_users', function (Blueprint $table) {
            $table->foreign(['bautisos_id'], 'fk_bautisos_has_users_bautisos1')->references(['id'])->on('bautisos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['users_id'], 'fk_bautisos_has_users_users1')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bautisos_has_users', function (Blueprint $table) {
            $table->dropForeign('fk_bautisos_has_users_bautisos1');
            $table->dropForeign('fk_bautisos_has_users_users1');
        });
    }
};
