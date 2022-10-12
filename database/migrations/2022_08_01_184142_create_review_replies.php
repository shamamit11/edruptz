<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_review_id'); 
            $table->unsignedBigInteger('instructor_id'); 
            $table->longText('description')->nullable();
            $table->foreign('course_review_id')->references('id')->on('course_reviews')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('instructor_id')->references('id')->on('instructors')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_replies');
    }
};
