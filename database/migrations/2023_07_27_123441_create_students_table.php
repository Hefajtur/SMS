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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('admission_no');
            $table->string('roll_no');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('mobile');
            $table->string('email');
            $table->foreignId('class_id')->constrained();    
            $table->foreignId('section_id')->constrained();    
            $table->foreignId('shift_id')->constrained();    
            $table->date('b_date');
            $table->bigInteger('religion');
            $table->bigInteger('gender');
            $table->bigInteger('category_id');    
            $table->bigInteger('blood');
            $table->date('admission_date');
            $table->string('image');
            $table->text('parent');
            $table->string('status')->default(1);
            $table->bigInteger('session_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
