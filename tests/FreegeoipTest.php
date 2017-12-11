<?php

use Siro\Freegeoip\Freegeoip;
use PHPUnit\Framework\TestCase;

class FreegeoipTest extends TestCase
{
    private $api;

    public function setUp()
    {
        $this->api = new Freegeoip([
            'host' => 'http://localhost:8000'
        ]);
    }

    public function testJsonOkResponse()
    {
        $response = $this->api->json('184.34.65.120');
        $this->assertObjectHasAttribute('ip', $response);
        $this->assertObjectHasAttribute('countryCode', $response);
        $this->assertObjectHasAttribute('countryName', $response);
        $this->assertObjectHasAttribute('regionCode', $response);
        $this->assertObjectHasAttribute('regionName', $response);
        $this->assertObjectHasAttribute('city', $response);
        $this->assertObjectHasAttribute('zipCode', $response);
        $this->assertObjectHasAttribute('timeZone', $response);
        $this->assertObjectHasAttribute('latitude', $response);
        $this->assertObjectHasAttribute('longitude', $response);
        $this->assertObjectHasAttribute('metroCode', $response);
    }

    public function testXmlOkResponse()
    {
        $response = $this->api->xml('184.34.65.120');
        $this->assertObjectHasAttribute('ip', $response);
        $this->assertObjectHasAttribute('countryCode', $response);
        $this->assertObjectHasAttribute('countryName', $response);
        $this->assertObjectHasAttribute('regionCode', $response);
        $this->assertObjectHasAttribute('regionName', $response);
        $this->assertObjectHasAttribute('city', $response);
        $this->assertObjectHasAttribute('zipCode', $response);
        $this->assertObjectHasAttribute('timeZone', $response);
        $this->assertObjectHasAttribute('latitude', $response);
        $this->assertObjectHasAttribute('longitude', $response);
        $this->assertObjectHasAttribute('metroCode', $response);
    }

    public function testCsvOkResponse()
    {
        $response = $this->api->csv('184.34.65.120');
        $this->assertObjectHasAttribute('ip', $response);
        $this->assertObjectHasAttribute('countryCode', $response);
        $this->assertObjectHasAttribute('countryName', $response);
        $this->assertObjectHasAttribute('regionCode', $response);
        $this->assertObjectHasAttribute('regionName', $response);
        $this->assertObjectHasAttribute('city', $response);
        $this->assertObjectHasAttribute('zipCode', $response);
        $this->assertObjectHasAttribute('timeZone', $response);
        $this->assertObjectHasAttribute('latitude', $response);
        $this->assertObjectHasAttribute('longitude', $response);
        $this->assertObjectHasAttribute('metroCode', $response);
    }
}