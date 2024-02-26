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
        Schema::create('issue_books', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('issue_book');
            $table->bigInteger('issue_book_member');
            $table->tinyInteger('status')->default(0)->comment('0=>inactive, 1=>active');
            $table->date('issue_date');
            $table->date('return_date');
            $table->integer('phone');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issue_books');
    }
};
