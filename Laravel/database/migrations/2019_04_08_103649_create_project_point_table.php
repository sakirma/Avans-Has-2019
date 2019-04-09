<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectPointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    # TODO: Put GeoJson Columns.
    public function up()
    {
        Schema::create('project_point', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id');

            $table->point('location');
            $table->geometryCollection('geo_json');

            $table->string('name');
            $table->string('information');
        });

        Schema::table('project_point', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('project')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_point');
    }
}
