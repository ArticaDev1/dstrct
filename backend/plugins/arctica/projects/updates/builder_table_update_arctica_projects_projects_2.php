<?php namespace Arctica\Projects\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateArcticaProjectsProjects2 extends Migration
{
    public function up()
    {
        Schema::table('arctica_projects_projects', function($table)
        {
            $table->text('project_attributes')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('arctica_projects_projects', function($table)
        {
            $table->dropColumn('project_attributes');
        });
    }
}
