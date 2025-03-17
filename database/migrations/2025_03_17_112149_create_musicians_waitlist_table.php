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
        Schema::create('musicians_waitlist', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('instagram')->unique();
            $table->string('phone')->unique();
            $table->string('extra_link')->nullable();
            $table->enum('status', ['pending', 'viewed', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('musicians_waitlist');
    }
};
