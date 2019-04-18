<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facets', function (Blueprint $table) {
            $table->bigInteger('project_id');
            $table->bigInteger('route_id');
            $table->string('information');
            
            $table->primary(['project_id', 'route_id']);
            $table->foreign('project_id')->on('id')->references('projects');
            $table->foreign('route_id')->on('id')->references('route');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facets');
    }
}
