<?php
namespace app\weixin\controller;

use think\Controller;
use think\Request;
use think\Session;

class WeixinAction
{
    private  $appid;
    private  $secret;

    public function _initialize(){
        $this->appid  =config('appid');
        $this->secret =config('secret');
    }


    public function get_AccessToken(){

    }

}
