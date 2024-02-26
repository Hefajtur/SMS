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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('book_category_id');
            $table->string('name');
            $table->string('code');
            $table->string('publisher_name');
            $table->string('author_name');
            $table->integer('rack_no');
            $table->integer('price');
            $table->string('quantity');
            $table->tinyInteger('status')->default(0)->comment('0=>inactive, 1=>active');
            $table->longText('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
