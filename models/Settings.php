<?php namespace TheDMSGrp\DynamicPhones\Models;

use System\Classes\SettingsManager;
use Model, BackendMenu, BackendAuth, Response, View;

/**
 * Class Settings
 * @package TheDMSGrp\DynamicPhones\Models
 */
class Settings extends Model
{
    /**
     * @var array
     */
    public $implement = ['System.Behaviors.SettingsModel'];

    /**
     * @var string
     */
    public $settingsCode = 'thedmsgrp_content_settings';

    /**
     * @var string
     */
    public $settingsFields = 'fields.yaml';

    /**
     * Settings constructor.
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('TheDMSGrp.Content', 'settings');
    }

}