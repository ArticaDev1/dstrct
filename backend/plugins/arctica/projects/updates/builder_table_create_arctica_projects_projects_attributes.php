<?php namespace Arctica\Projects\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateArcticaProjectsProjectsAttributes extends Migration
{
    public function up()
    {
        Schema::create('arctica_projects_projects_attributes', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('project_id');
            $table->integer('attribute_id');
            $table->string('value');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('arctica_projects_projects_attributes');
    }
}
