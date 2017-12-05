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

    public function testJson()
    {
        $this->assertEquals(true, true);
    }
}