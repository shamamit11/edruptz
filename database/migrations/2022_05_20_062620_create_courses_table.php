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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instructor_id'); 
            $table->unsignedBigInteger('category_id'); 
            $table->string('name', 255);
            $table->string('image', 255)->nullable();
			$table->mediumText('summary')->nullable();
            $table->longText('description')->nullable();
            $table->string('duration', 255)->nullable();
            $table->decimal('amount', 8, 2)->nullable();
			$table->string('lectures', 255)->nullable();
			$table->double('age_from', 10, 2)->nullable();
			$table->double('age_to', 10, 2)->nullable();
            $table->integer('complete')->nullable()->default(0);
            $table->string('slug', 255)->nullable();
            $table->boolean('status')->default(1);
			$table->string('meta_title', 255)->nullable();
			$table->mediumText('meta_description')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('courses');
    }
};
