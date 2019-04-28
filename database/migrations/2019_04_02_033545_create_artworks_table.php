<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artworks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->date('produced_at')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->json('dimensions');
            $table->unsignedBigInteger('borough_id');
            $table->point('location');
            $table->timestamps();

            $table->foreign('category_id')
                  ->references('id')->on('categories');
            $table->foreign('subcategory_id')
                  ->references('id')->on('subcategories');
            $table->foreign('borough_id')
                  ->references('id')->on('boroughs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artworks');
    }
}
