<?php namespace TheDMSGrp\DynamicPhones\Components;

use Cms\Classes\ComponentBase;

class DynamicPhone extends ComponentBase
{

    /**
     * Returns information about this component, including name and description.
     */
    public function componentDetails()
    {
        return [
            'name'        => 'Dynamic Phone Numbers',
            'description' => 'Injects a phone number into the page'
        ];
    }

    public function onRun()
    {
        $this->addJs('/plugins/thedmsgrp/dynamicphones/assets/js/jquery.cookie.js');
        $this->addJs('/plugins/thedmsgrp/dynamicphones/assets/js/jquery.dynamicphone.js');
    }
}