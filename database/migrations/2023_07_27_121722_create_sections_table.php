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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');     
            $table->foreignId('class_id')->constrained();
            $table->tinyInteger('status')->default(1);            
            $table->timestamps();

            // $table->interger('user_id')->unsigned();
            // $table->foreign('user_id')->references('id')->on('table_name')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
