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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('app_name');
            $table->string('footer_text');
            $table->string('light_logo');
            $table->string('dark_logo');
            $table->string('favicon');
            $table->foreignId('lang_id');
            $table->string('session');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->longText('about_school');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
