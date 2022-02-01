<?php namespace Arctica\Projects\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateArcticaProjectsGalleryTemplate extends Migration
{
    public function up()
    {
        Schema::create('arctica_projects_gallery_template', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('view_name');
            $table->integer('count_of_images');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('arctica_projects_gallery_template');
    }
}
