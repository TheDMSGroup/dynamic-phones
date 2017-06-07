<?php namespace TheDMSGrp\DynamicPhones\Models;

use Model;

/**
 * Model
 */
class Phone extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * Validation rules
     */
    public $rules = [
        'url' => 'sometimes|required',
        'phone' => 'required|numeric'
    ];

    /**
     * Attribute names
     */
    public $attributeNames = [];

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
     * Called before validating fields.
     */
    public function beforeValidate()
    {

        $parameters = $this->parameters;
        $urls = $this->urls;

        // Validate Parameters repeater.
        foreach ($parameters as $key => $value) {
            $this->rules['parameters.'. $key .'.dropdown'] = 'required';
            $this->rules['parameters.'. $key .'.value'] = 'required';

            $this->attributeNames['parameters.'. $key .'.dropdown'] = 'Dropdown';
            $this->attributeNames['parameters.'. $key .'.value'] = 'Value';
        }

        // Validate Url repeater.
        foreach ($urls as $key => $value) {
            $this->rules['urls.'. $key .'.urls'] = 'required';

            $this->attributeNames['urls.'. $key .'.urls'] = 'Url';
        }

    }

    /**
     * Populate dropdown list.
     * @param $fieldName
     * @param $value
     * @return mixed
     */
    public function getDropdownOptions($fieldName, $value)
    {
        $fields = Parameters::lists('name', 'name');

        return $fields;
    }

    /**
     * Strip out all columns except for phone, parameters and urls.
     * @param $query
     * @return mixed
     */
    public function scopeFilter($query)
    {
        return $query->select('phone', 'parameters', 'urls');
    }
}