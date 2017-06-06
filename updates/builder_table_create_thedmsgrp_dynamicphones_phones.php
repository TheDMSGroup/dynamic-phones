<?php namespace TheDMSGrp\DynamicPhones\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateThedmsgrpDynamicphonesPhones extends Migration
{
    public function up()
    {
        Schema::create('thedmsgrp_dynamicphones_phones', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('phone', 11);
            $table->boolean('default')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('thedmsgrp_dynamicphones_phones');
    }
}
