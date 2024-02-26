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
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->string('fath_name');
            $table->string('fath_mobile');
            $table->string('fath_prof');
            $table->string('fath_img');
            $table->string('mother_name');
            $table->string('mother_mobile');
            $table->string('mother_prof');
            $table->string('mother_img');
            $table->string('guard_name')->nullable();
            $table->string('guard_mobile')->nullable();
            $table->string('guard_prof')->nullable();
            $table->string('guard_img')->nullable();
            $table->string('guard_email')->nullable();
            $table->string('guard_address')->nullable();
            $table->string('guard_rel')->nullable();
            $table->tinyInteger('guard_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardians');
    }
};
