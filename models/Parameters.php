<?php namespace TheDMSGrp\DynamicPhones\Models;

use Model;

/**
 * Model
 */
class Parameters extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Validation
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'thedmsgrp_dynamicphones_parameters';
}