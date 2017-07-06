<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use App\Utility\ConnectionHelper;
use Illuminate\Http\Request;

class DummyController extends BaseController
{
    public function dummyGet()
    {
        return ConnectionHelper::HttpGet('vusers','userservice','test/?name=aa');
    }

    public function dummyPost()
    {
        $postData['username'] = 'c';
        $postData['password'] = 'ccc';
        return ConnectionHelper::HttpPost('vusers','userservice',$postData);
    } 

    public function dummyPut()
    {
        $postData['username'] = 'c';
        $postData['password'] = 'ccc';
        return ConnectionHelper::HttpPut('vusers','userservice',$postData);
    } 

    public function dummyDelete()
    {
        return ConnectionHelper::HttpDelete('vusers','userservice','test/?name=aa');
    }

    function dummyTest()
    {
        $postData['username'] = 'c';
        $postData['password'] = 'ccc';
        $res = 'Get:' . ConnectionHelper::HttpGet('vusers','userservice','test/?name=aa');
        $res = $res . ',Post:' . ConnectionHelper::HttpPost('vusers','userservice',$postData);
        $res = $res . ',Put:' . ConnectionHelper::HttpPut('vusers','userservice',$postData);
        $res = $res . ',Delete:' . ConnectionHelper::HttpDelete('vusers','userservice','test/?name=aa');
        return $res;
    }
}