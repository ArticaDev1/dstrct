<?php namespace Arctica\Pages\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateArcticaPagesEquipment2 extends Migration
{
    public function up()
    {
        Schema::create('arctica_pages_equipment', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->text('estimate');
            $table->string('slug');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('arctica_pages_equipment');
    }
}
