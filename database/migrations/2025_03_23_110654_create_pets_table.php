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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('logo')->nullable();
            $table->string('name')->nullable();
            $table->integer('age')->nullable();
            $table->string('breed')->nullable();
            $table->integer('gender')->nullable();
            $table->string('weight')->nullable();
            $table->text('medical_condition')->nullable();
            $table->text('addition_note')->nullable();
            $table->char('status',1)->default('Y')->comment('N => Inactive, Y => Active)');
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
