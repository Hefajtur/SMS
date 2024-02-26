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
        Schema::create('exam_routines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained();    
            $table->foreignId('section_id')->constrained();
            $table->tinyInteger('type')->default(0)->comment('0=>theory, 1=>practical');
            $table->date('date');
            $table->foreignId('subject_id')->constrained();  
            $table->foreignId('time_schedule_id')->constrained();  
            $table->foreignId('class_room_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_routines');
    }
};
