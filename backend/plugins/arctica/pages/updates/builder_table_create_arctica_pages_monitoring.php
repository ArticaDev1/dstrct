<?php namespace Arctica\Pages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateArcticaPagesMonitoring extends Migration
{
    public function up()
    {
        Schema::create('arctica_pages_monitoring', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('arctica_pages_monitoring');
    }
}
