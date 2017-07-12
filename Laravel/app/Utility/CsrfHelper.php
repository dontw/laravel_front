<?php

namespace App\Utility;

class CsrfHelper
{
    public static function GetCsrfToken()
    {
        $jdata = ConnectionHelper::HttpGet('csrf','userservice');
        $obj = json_decode($jdata, true);
        if($obj['status'] == 0)
        {
            return $obj['model']['token'];
        }
        return '';
    } 
}