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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id');
            $table->foreignId('role_id')->constrained();

            $table->string('designation_id');
            $table->string('department_id');

            // $table->foreignId('designation_id')->constrained();
            // $table->foreignId('department_id')->constrained();

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('email')->nullable();
            $table->enum('gender', ['M', 'F']);
            $table->date('dob')->nullable();
            $table->date('join_date')->nullable();
            $table->string('phone')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->enum('marital_status', ['married', 'unmarried']);
            $table->tinyInteger('status')->default(0);
            $table->string('image');
            $table->text('current_add')->nullable();
            $table->text('parmanent_add')->nullable();
            $table->string('basic_salary')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
