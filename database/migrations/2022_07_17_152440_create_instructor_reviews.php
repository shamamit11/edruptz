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
        Schema::create('instructor_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instructor_id'); 
            $table->unsignedBigInteger('student_id'); 
            $table->longText('description')->nullable();
            $table->integer('rating')->nullable();
            $table->foreign('instructor_id')->references('id')->on('instructors')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('student_id')->references('id')->on('students')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('instructor_reviews');
    }
};
