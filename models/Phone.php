<?php namespace TheDMSGrp\DynamicPhones\Models;

use Model;

/**
 * Model
 */
class Phone extends Model
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
    public $table = 'thedmsgrp_dynamicphones_phones';

    /**
     * @var array
     */
    protected $jsonable = [
        'parameters',
        'urls'
    ];

    /**
     * @param $fieldName
     * @param $value
     * @return mixed
     */
    public function getDropdownOptions($fieldName, $value)
    {
        $fields = Parameters::lists('name', 'name');

        return $fields;
    }
}