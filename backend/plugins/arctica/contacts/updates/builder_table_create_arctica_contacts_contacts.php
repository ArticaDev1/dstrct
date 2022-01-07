<?php namespace Arctica\Contacts\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateArcticaContactsContacts extends Migration
{
    public function up()
    {
        Schema::create('arctica_contacts_contacts', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('type_id');
            $table->string('value');
            $table->boolean('is_active')->default(true);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('arctica_contacts_contacts');
    }
}
