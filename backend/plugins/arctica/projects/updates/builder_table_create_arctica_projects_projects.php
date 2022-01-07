<?php namespace Arctica\Projects\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateArcticaProjectsProjects extends Migration
{
    public function up()
    {
        Schema::create('arctica_projects_projects', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->index(['name']);
            $table->index(['slug']);        
            $table->boolean('is_active')->default(true);
            $table->text('description');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('arctica_projects_projects');
    }
}
