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
        Schema::create('cart_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id'); 
            $table->unsignedBigInteger('course_id'); 
            $table->decimal('amount', 8, 2)->nullable();
            $table->decimal('admin_commission', 8, 2)->nullable();
            $table->timestamps();
            $table->foreign('cart_id')->references('id')->on('carts')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('course_id')->references('id')->on('courses')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_courses');
    }
};
