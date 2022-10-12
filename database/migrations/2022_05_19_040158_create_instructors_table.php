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
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->longText('about_me')->nullable();
            $table->string('address')->nullable();
            $table->string('professional')->nullable();
            $table->string('company')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->boolean('status')->default(1);
            $table->string('slug')->nullable();
            $table->string('verified_code')->nullable();
            $table->boolean('email_verified')->nullable()->default(0);
            $table->decimal('commission', 8, 2)->nullable();
            $table->boolean('admin_set')->nullable()->default(0);
            $table->string('stripe_id')->nullable();
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
        Schema::dropIfExists('instructors');
    }
};
