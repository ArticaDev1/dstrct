<?php namespace Arctica\Projects\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateArcticaProjectsProjects extends Migration
{
    public function up()
    {
        Schema::table('arctica_projects_projects', function($table)
        {
            $table->integer('sort_order')->default(0);
            $table->boolean('is_favorite')->default(false);
        });
    }
    
    public function down()
    {
        Schema::table('arctica_projects_projects', function($table)
        {
            $table->dropColumn('sort_order');
            $table->dropColumn('is_favorite');
        });
    }
}
