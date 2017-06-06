<?php namespace TheDMSGrp\DynamicPhones\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThedmsgrpDynamicphonesPhones2 extends Migration
{
    public function up()
    {
        Schema::table('thedmsgrp_dynamicphones_phones', function($table)
        {
            $table->text('urls');
        });
    }
    
    public function down()
    {
        Schema::table('thedmsgrp_dynamicphones_phones', function($table)
        {
            $table->dropColumn('urls');
        });
    }
}
