<?php namespace Arctica\Projects\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateArcticaProjectsProjects3 extends Migration
{
    public function up()
    {
        Schema::table('arctica_projects_projects', function($table)
        {
            $table->text('must_be_important')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('arctica_projects_projects', function($table)
        {
            $table->dropColumn('must_be_important');
        });
    }
}
