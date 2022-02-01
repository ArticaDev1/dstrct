<?php namespace Arctica\Projects\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateArcticaProjectsGalleries extends Migration
{
    public function up()
    {
        Schema::create('arctica_projects_galleries', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('project_id');
            $table->integer('gallery_id');
            $table->boolean('is_active');
            $table->integer('sort');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('arctica_projects_galleries');
    }
}
