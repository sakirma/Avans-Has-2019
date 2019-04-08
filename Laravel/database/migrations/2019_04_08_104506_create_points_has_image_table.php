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
            $table->unsignedInteger('project_id');
            $table->string('media_name');

            $table->primary(['project_id', 'media_name']);
        });

        Schema::table('points_has_image', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('project')->onDelete('cascade');
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
