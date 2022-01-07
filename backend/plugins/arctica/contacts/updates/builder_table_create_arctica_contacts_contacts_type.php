<?php namespace Arctica\Contacts\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateArcticaContactsContactsType extends Migration
{
    public function up()
    {
        Schema::create('arctica_contacts_contacts_type', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->boolean('is_social');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('arctica_contacts_contacts_type');
    }
}
