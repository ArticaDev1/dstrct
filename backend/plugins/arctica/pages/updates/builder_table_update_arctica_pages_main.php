<?php namespace Arctica\Pages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateArcticaPagesMain extends Migration
{
    public function up()
    {
        Schema::table('arctica_pages_main', function($table)
        {
            $table->text('images');
        });
    }
    
    public function down()
    {
        Schema::table('arctica_pages_main', function($table)
        {
            $table->dropColumn('images');
        });
    }
}
