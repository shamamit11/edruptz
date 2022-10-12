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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->unsignedBigInteger('page_section_id')->nullable();
			$table->mediumText('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('header_menu')->default(0);
            $table->boolean('footer_menu')->default(0);
            $table->integer('orders')->nullable()->default(1);
            $table->boolean('status')->default(1);
            $table->boolean('is_sitemap')->default(1);
			$table->string('meta_title')->nullable();
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
        Schema::dropIfExists('pages');
    }
};
