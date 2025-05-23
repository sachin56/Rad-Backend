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
        Schema::table('shop_vendors', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('logo')->nullable();
            $table->string('shop_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shop_vendors', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('logo')->nullable();
            $table->string('shop_name')->nullable();
        });
    }
};
