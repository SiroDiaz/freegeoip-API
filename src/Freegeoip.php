<?php declare(strict_types = 1);

namespace Siro\Freegeoip;

use SimpleXMLElement;

class Freegeoip
{
    private $host;

    public function __construct(array $params)
    {
        if(!isset($params['host'])) {
            throw new \IllegalArgumentException('"host" key not found in freegeoip config file');
        }
        $this->host = $params['host'];
    }

    public function json(string $ip)
    {
        $data = $this->request('json', $ip);
        $jsonObject = json_decode($data);

        $obj = new \stdclass();
        $obj->ip          = $jsonObject->ip;
        $obj->countryCode = $jsonObject->country_code;
        $obj->countryName = $jsonObject->country_name;
        $obj->regionCode  = $jsonObject->region_code;
        $obj->regionName  = $jsonObject->region_name;
        $obj->city        = $jsonObject->city;
        $obj->zipCode     = $jsonObject->zip_code;
        $obj->timeZone    = $jsonObject->time_zone;
        $obj->latitude    = $jsonObject->latitude;
        $obj->longitude   = $jsonObject->longitude;
        $obj->metroCode   = $jsonObject->metro_code;

        return $obj;
    }

    public function xml(string $ip)
    {
        $data = $this->request('xml', $ip);
        $xmlObject = new SimpleXMLElement($data);
        
        $obj = new \stdclass();
        $obj->ip          = (string) $xmlObject->IP[0];
        $obj->countryCode = (string) $xmlObject->CountryCode[0];
        $obj->countryName = (string) $xmlObject->CountryName[0];
        $obj->regionCode  = (string) $xmlObject->RegionCode[0];
        $obj->regionName  = (string) $xmlObject->RegionName[0];
        $obj->city        = (string) $xmlObject->City[0];
        $obj->zipCode     = (string) $xmlObject->ZipCode[0];
        $obj->timeZone    = (string) $xmlObject->TimeZone[0];
        $obj->latitude    = (string) $xmlObject->Latitude[0];
        $obj->longitude   = (string) $xmlObject->Longitude[0];
        $obj->metroCode   = (string) $xmlObject->MetroCode[0];

        return $obj;
    }

    public function csv(string $ip)
    {
        $data = $this->request('csv', $ip);
        $csvArray = explode(',', $data);

        $obj = new \stdclass();
        $obj->ip = $csvArray[0];
        $obj->countryCode = $csvArray[1];
        $obj->countryName = $csvArray[2];
        $obj->regionCode = $csvArray[3];
        $obj->regionName = $csvArray[4];
        $obj->city = $csvArray[5];
        $obj->zipCode = $csvArray[6];
        $obj->timeZone = $csvArray[7];
        $obj->latitude = $csvArray[8];
        $obj->longitude = $csvArray[9];
        $obj->metroCode = $csvArray[10];

        return $obj;
    }

    public function request(string $format = 'json', string $ip)
    {
        if($format !== 'json' && $format !== 'xml' && $format !== 'csv') {
            throw new \Exception("Unknow format.");
        }

        $url = "{$this->host}/{$format}/{$ip}";
        $response = $this->fetchUrl($url);
        return $response;
    }

    private function fetchUrl(string $url)
    {
        if(!function_exists('curl_init')) {
            throw new \Exception('curl not enabled');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        if($response == false) {
            throw new \Exception('error connecting with specified host');
        }

        return $response;
    }
}