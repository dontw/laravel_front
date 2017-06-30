<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use App\Utility\ConnectionHelper;

class UserController extends BaseController
{    
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function login()
    {        
        echo $this->dummyTest();
        return view('login');
    }

    public function loginApi($uid,$pwd)
    {
        $postData['username'] = $uid;
        $postData['password'] = $pwd;
        return ConnectionHelper::HttpPost('login',$postData);
    }    

    function dummyTest()
    {
        $postData['username'] = 'c';
        $postData['password'] = 'ccc';
        $res = 'Get:' . ConnectionHelper::HttpGet('vusers','test/?name=aa');
        $res = $res . ',Post:' . ConnectionHelper::HttpPost('vusers',$postData);
        $res = $res . ',Put:' . ConnectionHelper::HttpPut('vusers',$postData);
        $res = $res . ',Delete:' . ConnectionHelper::HttpDelete('vusers','test/?name=aa');
        return $res;
    }
}