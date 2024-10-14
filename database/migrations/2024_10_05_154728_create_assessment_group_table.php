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
        Schema::create('assessment_group', function (Blueprint $table) {
            $table->id();
            $table->string('sNumber');
            $table->unsignedBigInteger('assessmentID');
            $table->unsignedBigInteger('groupID');
            $table->foreign('sNumber')->references('sNumber')->on('users')->onDelete('cascade');
            $table->foreign('assessmentID')->references('id')->on('assessments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_group');
    }
};
