<?php namespace Arctica\Projects\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateArcticaProjectsAttributes extends Migration
{
    public function up()
    {
        Schema::table('arctica_projects_attributes', function($table)
        {
            $table->boolean('is_preview')->default(false);
        });
    }
    
    public function down()
    {
        Schema::table('arctica_projects_attributes', function($table)
        {
            $table->dropColumn('is_preview');
        });
    }
}
