<?php namespace TheDMSGrp\DynamicPhones\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThedmsgrpDynamicphonesPhones3 extends Migration
{
    public function up()
    {
        Schema::table('thedmsgrp_dynamicphones_phones', function($table)
        {
            $table->dropColumn('default');
        });
    }
    
    public function down()
    {
        Schema::table('thedmsgrp_dynamicphones_phones', function($table)
        {
            $table->boolean('default')->default(0);
        });
    }
}
