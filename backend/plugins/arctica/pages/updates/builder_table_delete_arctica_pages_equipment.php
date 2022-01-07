<?php namespace Arctica\Pages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeleteArcticaPagesEquipment extends Migration
{
    public function up()
    {
        Schema::dropIfExists('arctica_pages_equipment');
    }
    
    public function down()
    {
        Schema::create('arctica_pages_equipment', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 191);
            $table->text('about');
            $table->text('estimate');
            $table->integer('price');
        });
    }
}
