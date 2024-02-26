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
        Schema::create('modal_fee_collections', function (Blueprint $table) {
            $table->id();
            $table->date('due_date');
            $table->bigInteger('payment');
            $table->bigInteger('students_id');
            $table->bigInteger('amounts');
            $table->bigInteger('fine_amounts');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modal_fee_collections');
    }
};
