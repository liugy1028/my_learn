<?php
namespace app\weixin\controller;
use think\Controller ;
use think\Session;
use think\Request;
class Userinfo extends  Controller
{
    private $appid ='';
    private $secret='' ;
    public function _initialize(){
        Session::init();
        $this->appid = config('appid');
        $this->secret= config('secret');
    }

    //获取用户信息
    public function userinfo()
    {
        $userinfo  =Session::get('userinfo');
        if(isset($userinfo)){
            return $userinfo;
        }else{
            $code  =Request::instance()->param('code');
            //判断是否拿到code ，如拿到就去拿取用户信息
            if(isset($code)){

            }else{   //没拿到code， 就去微信拿code
                $code =$this->get_code();
            }
        }
    }

    //获取微信code
    public function get_code(){
        $redirect  =$_SERVER['REQUEST_URI'].'&response_type=code&scope=SCOPE&state=STATE#wechat_redirect';
        $url       ='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->appid.'&redirect_uri='.$redirect;
        $code      =http_content($url);
        var_dump($code);die;
    }
}
