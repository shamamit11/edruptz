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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('name', 255); 
			$table->mediumText('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('image', 255)->nullable();
            $table->boolean('status')->default(1);
            $table->string('slug', 255)->nullable();
            $table->boolean('is_sitemap')->default(1);
			$table->string('meta_title', 255)->nullable();
			$table->mediumText('meta_description')->nullable();
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
        Schema::dropIfExists('blogs');
    }
};
