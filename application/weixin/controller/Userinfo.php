<?php
namespace app\weixin\controller;
use think\Controller ;
use think\Session;
class Userinfo
{
    private $appid ;
    private $secret ;


    public function _initialize(){
        $appid = config('appid');
        $secret= config('secret');
        var_dump($appid);die;
    }

    public function userinfo($code)
    {
        $userinfo  =$_SESSION['userinfo'];
        if(isset($userinfo)){
            return $userinfo;
        }else{
            //判断是否拿到code ，如拿到就去拿取用户信息
            if(isset($code)){

            }else{   //没拿到code， 就去微信拿code
                $code =$this->get_code();
            }
        }
    }


    public function get_code(){
        https://open.weixin.qq.com/connect/oauth2/authorize?appid=APPID&redirect_uri=REDIRECT_URI&response_type=code&scope=SCOPE&state=STATE#wechat_redirect
        $redirect  =$_SERVER['REQUEST_URI'];
        $appid     =
    }
}
