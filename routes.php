<?php

Route::post('/api/dynamicnumbers/numbers', function() {

    $defaultNumber = \TheDMSGrp\DynamicPhones\Models\Settings::get('default_number', '8669841240');
    $cookieLife = \TheDMSGrp\DynamicPhones\Models\Settings::get('cookie_life', 1);

    $numbers = \TheDMSGrp\DynamicPhones\Models\Phone::select('phone', 'parameters', 'urls')->get()->toArray();

    foreach ($numbers as &$number) {

        // Convert parameters format
        if (is_array($number['parameters'])) {

            $parameters = [];

            foreach ($number['parameters'] as $parameter) {
                $parameters[$parameter['dropdown']] = $parameter['value'];
            }

            $number['parameters'] = $parameters;
        }

        // Convert urls format
        if (is_array($number['urls'])) {

            $urls = [];

            foreach ($number['urls'] as $url) {
                array_push($urls, $url['urls']);
            }

            $number['urls'] = $urls;

        }
    }

    return [
        'default' => $defaultNumber,
        'phones' => $numbers,
        'cookieExpiration' => $cookieLife
    ];
});

