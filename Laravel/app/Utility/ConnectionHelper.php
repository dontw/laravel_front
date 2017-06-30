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

    static function ApiUrl($action)
    {
        if(is_null(self::$apiList))
        {
            $apiList = self::loadJSON('apiurl');
        }        
        return $apiList[$action];
    }

    public static function HttpPost($action,$postData)
    {
        $client = new Client();
        $url = self::ApiUrl($action);
        $res = $client->post($url, ['json' => $postData]);
        $body = $res->getBody();
        return $body;
    }

    public static function HttpPut($action,$postData)
    {
        $client = new Client();
        $url = self::ApiUrl($action);
        $res = $client->put($url, ['json' => $postData]);
        $body = $res->getBody();
        return $body;
    }

    public static function HttpGet($action,$query)
    {
        $client = new Client();
        $url = self::ApiUrl($action) . $query;
        $res = $client->get($url);
        $body = $res->getBody();
        return $body;
    }

    public static function HttpDelete($action,$query)
    {
        $client = new Client();
        $url = self::ApiUrl($action) . $query;
        $res = $client->delete($url);
        $body = $res->getBody();
        return $body;
    }
}