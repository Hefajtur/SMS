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
        Schema::create('userstaffs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('staffID');
            $table->bigInteger('role_id');
            $table->bigInteger('designation_id');
            $table->bigInteger('department_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('email');
            $table->string('gender');
            $table->string('dob');
            $table->string('join_date');
            $table->string('phone');
            $table->string('emergency_contact');
            $table->string('marital_status');
            $table->string('status');
            $table->string('image');
            $table->string('current_add');
            $table->string('permanent_add');
            $table->string('basic_salary');
            $table->string('doc_name')->nullable();
            $table->string('doc_img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userstaffs');
    }
};
