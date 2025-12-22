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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            
            // Personal Information
            $table->string('name');
            $table->string('mobile');
            
            // Experience Questions
            $table->string('overall_experience'); // excellent, good, average, poor
            $table->string('cleanliness'); // very_satisfied, satisfied, somewhat_satisfied, not_satisfied
            $table->string('room_condition'); // excellent, good, average, poor
            $table->string('bathroom_cleanliness'); // excellent, good, average, poor
            $table->string('staff_behaviour'); // very_good, good, average, poor
            $table->string('basic_facilities'); // excellent, good, average, faced_problems
            $table->string('money_return'); // yes, no
            $table->string('stay_again'); // yes, maybe
            $table->string('recommend'); // yes, maybe
            
            // Additional Comments
            $table->text('suggestions')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
