<?php

declare(strict_types=1);

namespace App\Controllers;

use App\models\CacheModel;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ShipmentInfoController
{
    /**
     * @var CacheModel
     */
    public $cache;

    public function __construct(CacheModel $cache) {
        $this->cache = $cache;
    }

    /**
     * Pass post data as argument
     */
    public function getShippingRates($postData)
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                // Return a Bad Request
                http_response_code(400);
                return json_encode(["error" => "Bad Request"]);
            }

            // Get the data from the request body
            $countryCode = $postData["recipient"]["country_code"];
            // Create unique key based on country code
            $key = 'shipment.info.' . $countryCode;
            $result = $this->cache->get($key);

            if ($result) {
                return json_encode($result);
            }

            $client = new Client();
            $res = $client->request('POST', 'https://api.printful.com/shipping/rates', [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode($_ENV['API_KEY'])
                ],
                'json' => $postData
            ]);

            if ($res->getStatusCode() == 200) {
                $this->cache->set($key, json_decode((string)$res->getBody()), 60);
                return $res->getBody();
            }
        } catch (GuzzleException $ex) {
            http_response_code($ex->getCode());
            return $ex->getMessage();
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}