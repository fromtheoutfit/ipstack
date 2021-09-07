<?php
/**
 * ipstack plugin for Craft CMS 3.x
 *
 * Simple custom wrapper around the ipstack api.
 *
 * @link      https://www.theout.fit
 * @copyright Copyright (c) 2020 The Outfit, Inc
 */

namespace fromtheoutfit\ipstack\services;

use fromtheoutfit\ipstack\Ipstack;

use Craft;
use craft\base\Component;

/**
 * IpstackService Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    The Outfit, Inc
 * @package   Ipstack
 * @since     1.0.0
 */
class IpstackService extends Component
{
    private $access_key = '';

    public function __construct()
    {
        $this->access_key = getenv('IPSTACK_ACCESS_KEY');
    }

    // Public Methods
    // =========================================================================

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     Ipstack::$plugin->ipstackService->exampleService()
     *
     * @return mixed
     */
    public function getCountry()
    {
        $ip   = $this->getIpAddress();
        $data = '';

        // set IP address and API access key

        // Initialize CURL:
        $ch = curl_init('http://api.ipstack.com/' . $ip . '?access_key=' . $this->access_key . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

        // make sure we got a curl response
        if ($json) {
            // Decode JSON response:
            $api_result = json_decode($json, true);

            // The api only returns a success key if that key is set to false...which is fun.
            // So we look for that key and then we look to make sure it is false
            // and then we set the data to an empty string
            if (array_key_exists('success', $api_result) && !$api_result['success']) {
                $data = '';
            } else {
                $data = strtolower($api_result['country_code']);
            }
        }

        return $data;
    }

    public function get()
    {
        $ip   = $this->getIpAddress();
        $data = '';

        // set IP address and API access key

        // Initialize CURL:
        $ch = curl_init('http://api.ipstack.com/' . $ip . '?access_key=' . $this->access_key . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

        // make sure we got a curl response
        if ($json) {
            // Decode JSON response:
            $api_result = json_decode($json, true);

            // The api only returns a success key if that key is set to false...which is fun.
            // So we look for that key and then we look to make sure it is false
            // and then we set the data to an empty string
            if (array_key_exists('success', $api_result) && !$api_result['success']) {
                $data = [];
            } else {
                $data = $api_result;
            }
        }

        return $data;
    }


    private function getIpAddress()
    {
        $ip = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? Craft::$app->getRequest()->getUserIP();
        Craft::error('DebugIP: ' . $ip);
        return $ip;
    }
}
