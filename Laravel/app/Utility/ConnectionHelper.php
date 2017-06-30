<?php

namespace App\Utility;
use GuzzleHttp\Client;

class ConnectionHelper
{
    static $apiList;

    public static function loadJSON($filename) 
    {        
        $path = storage_path() . "/json/${filename}.json";
        if (!file_exists($path)) 
        {
            throw new Exception("Invalid File");
        }
        $json = json_decode(file_get_contents($path), true);
        return $json;
    }

    static function ApiUrl($action,$serviceName)
    {
        if(is_null(self::$apiList))
        {
            $apiList = self::loadJSON('apiurl');
        }
        $service = $apiList[$serviceName];        
        return $service['base'] . $service[$action];
    }

    public static function HttpGet($action,$serviceName,$query)
    {
        $client = new Client();
        $url = self::ApiUrl($action,$serviceName) . $query;
        $res = $client->get($url);
        $body = $res->getBody();
        return $body;
    }

    public static function HttpPost($action,$serviceName,$postData)
    {
        $client = new Client();
        $url = self::ApiUrl($action,$serviceName);
        $res = $client->post($url, ['json' => $postData]);
        $body = $res->getBody();
        return $body;
    }

    public static function HttpPut($action,$serviceName,$postData)
    {
        $client = new Client();
        $url = self::ApiUrl($action,$serviceName);
        $res = $client->put($url, ['json' => $postData]);
        $body = $res->getBody();
        return $body;
    }    

    public static function HttpDelete($action,$serviceName,$query)
    {
        $client = new Client();
        $url = self::ApiUrl($action,$serviceName) . $query;
        $res = $client->delete($url);
        $body = $res->getBody();
        return $body;
    }
}