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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->constrained();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('dashboard')->default(0);
            $table->enum('student', ['R', 'C', 'U', 'D']);
            $table->enum('student_cat', ['R', 'C', 'U', 'D']);
            $table->enum('promote_students', ['R', 'C']);
            $table->enum('disabled_students', ['R', 'C']);
            $table->enum('parent', ['R', 'C', 'U', 'D']);
            $table->enum('admission', ['R', 'C', 'U', 'D']);
            $table->enum('classes', ['R', 'C', 'U', 'D']);
            $table->enum('section', ['R', 'C', 'U', 'D']);
            $table->enum('shift', ['R', 'C', 'U', 'D']);
            $table->enum('class_setup', ['R', 'C', 'U', 'D']);
            $table->enum('subject', ['R', 'C', 'U', 'D']);
            $table->enum('subject_assign', ['R', 'C', 'U', 'D']);
            $table->tinyInteger('class_routine')->default(0);
            $table->enum('time_schedule', ['R', 'C', 'U', 'D']);
            $table->enum('class_room', ['R', 'C', 'U', 'D']);
            $table->enum('fees_group', ['R', 'C', 'U', 'D']);
            $table->enum('fees_type', ['R', 'C', 'U', 'D']);
            $table->enum('fees_master', ['R', 'C', 'U', 'D']);
            $table->enum('fees_assign', ['R', 'C', 'U', 'D']);
            $table->enum('fees_collect', ['R', 'C', 'U', 'D']);
            $table->enum('exam_type', ['R', 'C', 'U', 'D']);
            $table->enum('marks_grade', ['R', 'C', 'U', 'D']);
            $table->enum('exam_assign', ['R', 'C', 'U', 'D']);
            $table->tinyInteger('exam_routine')->default(0);
            $table->enum('marks_register', ['R', 'C', 'U', 'D']);
            $table->enum('homework', ['R', 'C', 'U', 'D']);
            $table->enum('exam_setting', ['R', 'U']);
            $table->enum('account_head', ['R', 'C', 'U', 'D']);
            $table->enum('income', ['R', 'C', 'U', 'D']);
            $table->enum('expense', ['R', 'C', 'U', 'D']);
            $table->enum('attendance', ['R', 'C']);
            $table->tinyInteger('attendance_report')->default(0);
            $table->tinyInteger('marksheet')->default(0);
            $table->tinyInteger('merit_list')->default(0);
            $table->tinyInteger('progress_card')->default(0);
            $table->tinyInteger('due_fees')->default(0);
            $table->tinyInteger('fees_collection')->default(0);
            $table->tinyInteger('transaction')->default(0);
            $table->enum('language', ['R', 'C', 'U', 'D']);
            $table->enum('Roles', ['R', 'C', 'U', 'D']);
            $table->enum('Users', ['R', 'C', 'U', 'D']);
            $table->enum('department', ['R', 'C', 'U', 'D']);
            $table->enum('designation', ['R', 'C', 'U', 'D']);
            $table->enum('sections', ['R', 'C', 'U', 'D']);
            $table->enum('slider', ['R', 'C', 'U', 'D']);
            $table->enum('about', ['R', 'C', 'U', 'D']);
            $table->enum('counter', ['R', 'C', 'U', 'D']);
            $table->enum('contact_info', ['R', 'C', 'U', 'D']);
            $table->enum('dep_contact', ['R', 'C', 'U', 'D']);
            $table->enum('news', ['R', 'C', 'U', 'D']);
            $table->enum('event', ['R', 'C', 'U', 'D']);
            $table->enum('gallery_category', ['R', 'C', 'U', 'D']);
            $table->enum('gallery', ['R', 'C', 'U', 'D']);
            $table->tinyInteger('subscribe')->default(0);
            $table->tinyInteger('contact_message')->default(0);
            $table->enum('general_settings', ['R', 'U']);
            $table->enum('storage_settings', ['R', 'U']);
            $table->enum('task_schedules', ['R', 'U']);
            $table->enum('recaptcha_settings', ['R', 'U']);
            $table->enum('email_settings', ['R', 'U']);
            $table->enum('genders', ['R', 'C', 'U', 'D']);
            $table->enum('religions', ['R', 'C', 'U', 'D']);
            $table->enum('blood_groups', ['R', 'C', 'U', 'D']);
            $table->enum('sessions', ['R', 'C', 'U', 'D']);
            $table->enum('book_category', ['R', 'C', 'U', 'D']);
            $table->enum('book', ['R', 'C', 'U', 'D']);
            $table->enum('member', ['R', 'C', 'U', 'D']);
            $table->enum('member_category', ['R', 'C', 'U', 'D']);
            $table->enum('issue_book', ['R', 'C', 'U', 'D']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
