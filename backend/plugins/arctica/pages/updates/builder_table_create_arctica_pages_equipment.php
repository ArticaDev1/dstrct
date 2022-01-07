<?php namespace Arctica\Pages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateArcticaPagesEquipment extends Migration
{
    public function up()
    {
        Schema::create('arctica_pages_equipment', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->text('about');
            $table->text('estimate');
            $table->integer('price');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('arctica_pages_equipment');
    }
}
