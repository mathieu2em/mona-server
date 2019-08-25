<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artists', function (Blueprint $table) {
            $table->string('alias')->nullable();
            $table->boolean('consent')->default(false);
            $table->boolean('edited')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artists', function (Blueprint $table) {
            $table->dropColumn('edited');
            $table->dropColumn('consent');
            $table->dropColumn('alias');
        });
    }
}
