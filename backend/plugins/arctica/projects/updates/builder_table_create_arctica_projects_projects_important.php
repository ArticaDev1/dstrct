<?php namespace Arctica\Projects\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateArcticaProjectsProjectsImportant extends Migration
{
    public function up()
    {
        Schema::create('arctica_projects_projects_important', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('project_id');
            $table->text('value');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('arctica_projects_projects_important');
    }
}
