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
        
        Schema::create('masters', function (Blueprint $table) {
            $table->id();
            $table->string('group_id');
            $table->string('type_id');
            $table->date('due_date');
            $table->bigInteger('amount');
            $table->string('fine_type')->nullable();
            $table->string('percentage')->nullable();
            $table->bigInteger('fine_amount')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=>Inactive, 1=>Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masters');
    }
};
