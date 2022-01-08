<?php namespace Arctica\Projects\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateArcticaProjectsProjects5 extends Migration
{
    public function up()
    {
        Schema::table('arctica_projects_projects', function($table)
        {
            $table->string('main_page_description')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('arctica_projects_projects', function($table)
        {
            $table->dropColumn('main_page_description');
        });
    }
}
