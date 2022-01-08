<?php namespace Arctica\Projects\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateArcticaProjectsProjects6 extends Migration
{
    public function up()
    {
        Schema::table('arctica_projects_projects', function($table)
        {
            $table->dropColumn('is_view_for_main_page');
            $table->dropColumn('main_page_description');
        });
    }
    
    public function down()
    {
        Schema::table('arctica_projects_projects', function($table)
        {
            $table->boolean('is_view_for_main_page')->default(0);
            $table->string('main_page_description', 191)->nullable();
        });
    }
}
