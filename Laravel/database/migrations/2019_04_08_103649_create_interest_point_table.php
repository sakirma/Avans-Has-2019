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
        Schema::create('interest_point', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id')->nullable();

            $table->point('location');
            $table->geometryCollection('area')->nullable();

            $table->string('name');
            $table->string('information');
            $table->string('category')->nullable();
        });

        Schema::table('interest_point', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('project')->onDelete('cascade');
            $table->foreign('category')->references('name')->on('category')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interest_point');
    }
}
