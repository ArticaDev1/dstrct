<?php namespace Arctica\Pages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateArcticaPagesMain extends Migration
{
    public function up()
    {
        Schema::create('arctica_pages_main', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->text('about');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('arctica_pages_main');
    }
}
