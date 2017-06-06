<?php namespace TheDMSGrp\DynamicPhones;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{

    public function registerComponents()
    {
        return [
            'TheDMSGrp\DynamicPhones\Components\DynamicPhone' => 'dynamicPhone'
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Settings',
                'description' => 'Configure Dynamic Phone settings.',
                'category'    => 'DynamicPhone',
                'icon'        => 'icon-cog',
                'class'       => 'TheDMSGrp\DynamicPhones\Models\Settings',
                'order'       => 500,
                'keywords'    => 'dynamic phone configure',
                'permissions' => ['thedmsgrp.content.generalaccess']
            ]
        ];
    }
}
