<?php
namespace app\weixin\controller;
use think\Controller ;
use think\Session;
use think\Request;
class Userinfo
{
    private $appid ;
    private $secret ;


    public function _initialize(){
        $request =Request::instance();
        $appid = config('appid');
        $secret= config('secret');
        var_dump($appid);die;
    }

    public function userinfo()
    {
        $userinfo  =$_SESSION['userinfo'];
        if(isset($userinfo)){
            return $userinfo;
        }else{
            $code  =$request->param('code');
            //判断是否拿到code ，如拿到就去拿取用户信息
            if(isset($code)){

            }else{   //没拿到code， 就去微信拿code
                $code =$this->get_code();
            }
        }
    }


    public function get_code(){
        $redirect  =$_SERVER['REQUEST_URI'];
        $appid     =$this->appid;
    }
}
