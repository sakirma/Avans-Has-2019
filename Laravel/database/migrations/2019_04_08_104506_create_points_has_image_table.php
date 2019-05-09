<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointsHasImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points_has_image', function (Blueprint $table) {
            $table->unsignedInteger('point_id');
            $table->string('media_name');

            $table->primary(['point_id', 'media_name']);
        });

        Schema::table('points_has_image', function (Blueprint $table) {
            $table->foreign('point_id')->references('id')->on('project_point')->onDelete('cascade');
            $table->foreign('media_name')->references('name')->on('media')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('points_has_image');
    }
}
