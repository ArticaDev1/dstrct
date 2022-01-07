<?php namespace Arctica\Contacts\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateArcticaContactsContactsType extends Migration
{
    public function up()
    {
        Schema::table('arctica_contacts_contacts_type', function($table)
        {
            $table->string('slug');
        });
    }
    
    public function down()
    {
        Schema::table('arctica_contacts_contacts_type', function($table)
        {
            $table->dropColumn('slug');
        });
    }
}
