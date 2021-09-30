<?php

declare(strict_types=1);

require('vendor/autoload.php');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

final class ShipmentInfoTest extends TestCase
{

    /**
     * @throws GuzzleException
     */
    public function testShippingRates()
    {
        $data = [
            "recipient" => [
                "address1" => "19749 Dearborn St",
                "city" => "Chatsworth",
                "country_code" => "US",
                "state_code" => "CA",
                "zip" => 91311
            ],
            "items" => [
                [
                    "quantity" => 1,
                    "variant_id" => 2
                ],
                [
                    "quantity" => 5,
                    "variant_id" => 202
                ]
            ]
        ];

        $client = new Client([
            'base_uri' => 'http://localhost:8080'
        ]);
        $response = $client->request('post', '/api.php', [
            'json' => $data
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $responseBody = (string)$response->getBody();
        $this->assertJson($responseBody);
        $contents = json_decode($responseBody, true);
        $this->assertEquals(200, $contents['code'], 'Request successful');
        $this->assertArrayHasKey('result', $contents, 'Response has key, result');
        $this->assertEquals("STANDARD", $contents['result'][0]['id'], 'Response has result with id value of STANDARD');
    }
}