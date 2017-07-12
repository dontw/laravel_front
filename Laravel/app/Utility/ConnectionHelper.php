<?php

namespace App\Utility;
use GuzzleHttp\Client;
use Cookie;

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

    static function GetRequest($csrf_token='',$auth_token='')
    {
        $headers = array();
        
        $headers += array('X-CSRF-TOKEN' => $csrf_token);    
        if(isset($_COOKIE['AUTH-TOKEN'])) 
        {
            $headers += array('authorization' => $_COOKIE['AUTH-TOKEN']);   
        }  
        else
        {
            if($auth_token=='') 
            {
                $headers += array('authorization' => '-1');
            }  
            else
            {
                $headers += array('authorization' => $auth_token);
            }            
        }   
        $client = new Client(['headers' => $headers]);  
        return $client; 
    }

    public static function HttpGet($action,$serviceName,$query='',$csrf_token='',$auth_token='')
    {
        $client = self::GetRequest($csrf_token,$auth_token);        
        $url = self::ApiUrl($action,$serviceName) . $query;
        $res = $client->get($url);
        $body = $res->getBody();
        return $body;
    }

    public static function HttpPost($action,$serviceName,$postData,$csrf_token='',$auth_token='')
    {
        $client = self::GetRequest($csrf_token,$auth_token); 
        $url = self::ApiUrl($action,$serviceName);
        $res = $client->post($url, ['json' => $postData]);
        $body = $res->getBody();
        return $body;
    }

    public static function HttpPut($action,$serviceName,$postData,$csrf_token='',$auth_token='')
    {
        $client = self::GetRequest($csrf_token,$auth_token); 
        $url = self::ApiUrl($action,$serviceName);
        $res = $client->put($url, ['json' => $postData]);
        $body = $res->getBody();
        return $body;
    }    

    public static function HttpDelete($action,$serviceName,$query,$csrf_token='',$auth_token='')
    {
        $client = self::GetRequest($csrf_token,$auth_token); 
        $url = self::ApiUrl($action,$serviceName) . $query;
        $res = $client->delete($url);
        $body = $res->getBody();
        return $body;
    }
}