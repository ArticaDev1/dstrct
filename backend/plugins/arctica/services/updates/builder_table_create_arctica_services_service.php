<?php namespace Arctica\Services\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateArcticaServicesService extends Migration
{
    public function up()
    {
        Schema::create('arctica_services_service', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->index(['slug']);
            $table->text('about')->nullable();
            $table->string('page_slug')->nullable();
            $table->integer('price')->nullable();
            $table->integer('price_description')->nullable();
            $table->string('signature')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('arctica_services_service');
    }
}
