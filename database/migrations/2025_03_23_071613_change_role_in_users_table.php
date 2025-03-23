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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('userRoleId')->nullable();
            $table->foreign('userRoleId')->references('id')->on('roles');
            $table->unsignedInteger('createdBy')->nullable();
            $table->unsignedInteger('editedBy')->nullable();
            $table->unsignedInteger('deletedBy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
