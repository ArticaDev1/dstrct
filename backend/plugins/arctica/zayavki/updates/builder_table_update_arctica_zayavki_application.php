<?php namespace Arctica\Zayavki\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateArcticaZayavkiApplication extends Migration
{
    public function up()
    {
        Schema::table('arctica_zayavki_application', function($table)
        {
            $table->string('from');
        });
    }
    
    public function down()
    {
        Schema::table('arctica_zayavki_application', function($table)
        {
            $table->dropColumn('from');
        });
    }
}
