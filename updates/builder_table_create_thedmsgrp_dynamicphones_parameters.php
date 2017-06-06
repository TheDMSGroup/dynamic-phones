<?php namespace TheDMSGrp\DynamicPhones\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateThedmsgrpDynamicphonesParameters extends Migration
{
    public function up()
    {
        Schema::create('thedmsgrp_dynamicphones_parameters', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 100);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('thedmsgrp_dynamicphones_parameters');
    }
}
