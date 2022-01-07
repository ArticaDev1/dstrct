<?php namespace Arctica\Zayavki\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateArcticaZayavkiApplication extends Migration
{
    public function up()
    {
        Schema::create('arctica_zayavki_application', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('phone');
            $table->string('name');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('arctica_zayavki_application');
    }
}
