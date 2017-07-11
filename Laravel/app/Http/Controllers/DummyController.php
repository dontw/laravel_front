<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use App\Utility\ConnectionHelper;
use Illuminate\Http\Request;

class DummyController extends BaseController
{
    public function dummyGet()
    {
        return ConnectionHelper::HttpGet('dummy','userservice','test/?name=aa');
    }

    public function dummyPost()
    {
        $postData['result'] = 'ccc';
        return ConnectionHelper::HttpPost('dummy','userservice',$postData);
    } 

    public function dummyPut()
    {
        $postData['result'] = 'ccc';
        return ConnectionHelper::HttpPut('dummy','userservice',$postData);
    } 

    public function dummyDelete()
    {
        return ConnectionHelper::HttpDelete('dummy','userservice','test/?name=aa');
    }

    function dummyTest()
    {
        $postData['result'] = 'ccc';
        $res = 'Get:' . ConnectionHelper::HttpGet('dummy','userservice','test/?name=aa');
        $res = $res . ',Post:' . ConnectionHelper::HttpPost('dummy','userservice',$postData);
        $res = $res . ',Put:' . ConnectionHelper::HttpPut('dummy','userservice',$postData);
        $res = $res . ',Delete:' . ConnectionHelper::HttpDelete('dummy','userservice','test/?name=aa');
        return $res;
    }
}