<?php namespace TheDMSGrp\DynamicPhones\Controllers;

use TheDMSGrp\DynamicPhones\Models\Settings;
use TheDMSGrp\DynamicPhones\Models\Phone;
use Illuminate\Routing\Controller;

/**
 * Class ApiController
 * @package TheDMSGrp\DynamicPhones\Controllers
 */
class ApiController extends Controller
{

    /**
     * Fetch dynamic phone numbers
     * @return array
     */
    public function fetchNumbers()
    {
        $defaultNumber = Settings::get('default_number', '8669841240');
        $cookieLife = Settings::get('cookie_life', 1);

        if (empty($defaultNumber)) {
            $defaultNumber = '8669841240';
        }

        $numbers = Phone::filter()->get()->toArray();

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
    }

}