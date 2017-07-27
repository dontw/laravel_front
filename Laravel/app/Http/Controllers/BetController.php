<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use App\Utility\ConnectionHelper;
use Illuminate\Http\Request;
use Cookie;
use Illuminate\Routing\Redirector;
use App\Utility\CsrfHelper;

class BetController extends BaseController
{
    public function betaction()
    {      
        $csrf = CsrfHelper::GetCsrfToken();
        if($csrf != '')
        {                
            $rsp = ConnectionHelper::HttpGet('account_balance','userservice','',$csrf);  
            $json = json_decode($rsp);
            $cash = $json->model->cashBalance;
            $chip = $json->model->chipBalance;            
            return view('betaction_view')->with('csrf', $csrf)->with('cash' , $cash)->with('chip' , $chip);
        }
        else
        {
            return redirect()->route('login');    
        }             
    }
    public function rollbackaction()
    {      
        $csrf = CsrfHelper::GetCsrfToken();
        if($csrf != '')
        {                
            $rsp = ConnectionHelper::HttpGet('account_balance','userservice','',$csrf);  
            $json = json_decode($rsp);
            return view('rollbackaction_view')->with('csrf', $csrf);
        }
        else
        {
            return redirect()->route('login');    
        }             
    }

    public function betApi(Request $request)
    {      
        $bodyContent = $request->getContent();
        $csrf = $request->header('X-CSRF-TOKEN');
        $auth = $request->header('AUTH-TOKEN'); 
        $postData['totalBet'] = 1;  
        $postData['selectedNumbers'] = $bodyContent;    
        $rsp = ConnectionHelper::HttpPost('bet','userservice',$postData,$csrf,$auth);  
        return $rsp;
    }

    public function rollbackApi(Request $request)
    {      
        $bodyContent = $request->getContent();
        $csrf = $request->header('X-CSRF-TOKEN');
        $auth = $request->header('AUTH-TOKEN'); 
        $postData['drawNumber'] = $bodyContent;    
        $rsp = ConnectionHelper::HttpPost('hkjc_rollback','userservice',$postData);  
        return $rsp;
    }

    //檢查是否登入
    public function betInfo()
    {        
        $csrf = CsrfHelper::GetCsrfToken();
        if($csrf != '')
        {
            $rsp = ConnectionHelper::HttpGet('userbet','userservice','',$csrf);
            return view('betinfo')->with('infos', $rsp);
        }
        else
        {
            return redirect()->route('login');    
        }      
    }

    public function resultHKJC()
    {        
        $csrf = CsrfHelper::GetCsrfToken();
        if($csrf != '')
        {
            $rsp = ConnectionHelper::HttpGet('hkjc','userservice','',$csrf);
            return view('hkjc_view')->with('data', $rsp);
        }
        else
        {
            return redirect()->route('login');    
        }      
    }
}