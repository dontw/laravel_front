<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use App\Utility\ConnectionHelper;
use Illuminate\Http\Request;
use Cookie;
use Illuminate\Routing\Redirector;
use App\Utility\CsrfHelper;

class UserController extends BaseController
{    
    public function login()
    {           
        return view('login_view');
    }

    //檢查是否登入
    public function userInfo()
    {        
        $csrf = CsrfHelper::GetCsrfToken();
        if($csrf != '')
        {
           return view('info');
        }
        else
        {
           return redirect()->route('login');    
        }      
    }

    public function loginApi($uid,$pwd)
    {
        $postData['username'] = $uid;
        $postData['password'] = $pwd;
        return ConnectionHelper::HttpPost('login','userservice',$postData);
    }   

    public function userApi(Request $request,$user_name)
    {
        $csrf = $request->header('X-CSRF-TOKEN');
        $auth = $request->header('AUTH-TOKEN');
        return ConnectionHelper::HttpGet('users','userservice',$user_name,$csrf,$auth);
    }           
}