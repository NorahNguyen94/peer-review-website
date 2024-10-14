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
        Schema::create('peer_reviews', function (Blueprint $table) {
            $table->id();
            $table->text('reviewText');
            $table->string('revieweeID');
            $table->string('reviewerID');
            $table->unsignedBigInteger('assessmentID');
            $table->foreign('reviewerID')->references('sNumber')->on('users')->onDelete('cascade');
            $table->foreign('assessmentID')->references('id')->on('assessments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
