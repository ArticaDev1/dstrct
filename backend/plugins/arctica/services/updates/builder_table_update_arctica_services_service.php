<?php namespace Arctica\Services\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateArcticaServicesService extends Migration
{
    public function up()
    {
        Schema::table('arctica_services_service', function($table)
        {
            $table->string('price_description', 10)->nullable()->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('arctica_services_service', function($table)
        {
            $table->integer('price_description')->nullable()->unsigned(false)->default(null)->change();
        });
    }
}
