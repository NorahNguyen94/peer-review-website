<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('instruction');
            $table->unsignedInteger('numberOfReview');
            $table->dateTime('dueDateTime');
            $table->unsignedInteger('maxScore');
            $table->enum('type', ['teacher-assign', 'student-selected']);
            $table->string('courseCode');
            $table->foreign('courseCode')->references('courseCode')->on('courses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
