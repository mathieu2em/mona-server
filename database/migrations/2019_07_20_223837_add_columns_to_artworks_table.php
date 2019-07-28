<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToArtworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->unsignedBigInteger('collection_id')->nullable();
            $table->text('details')->default("");
            $table->boolean('edited')->default(false);

            $table->foreign('collection_id')
                  ->references('id')->on('collections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->dropForeign(['collection_id']);

            $table->dropColumn('edited');
            $table->dropColumn('details');
            $table->dropColumn('collection_id');
        });
    }
}
