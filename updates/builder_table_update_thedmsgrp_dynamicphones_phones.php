<?php namespace TheDMSGrp\DynamicPhones\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThedmsgrpDynamicphonesPhones extends Migration
{
    public function up()
    {
        Schema::table('thedmsgrp_dynamicphones_phones', function($table)
        {
            $table->text('parameters');
        });
    }
    
    public function down()
    {
        Schema::table('thedmsgrp_dynamicphones_phones', function($table)
        {
            $table->dropColumn('parameters');
        });
    }
}
