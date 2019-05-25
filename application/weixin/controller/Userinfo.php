<?php
namespace app\weixin\controller;
use think\Controller ;
use think\Session;
use think\Request;
class Userinfo extends  Controller
{
    private $appid ='';
    private $secret='';
    private $is_no ='';
    public function _initialize(){
        Session::init();
        $this->appid = config('appid');
        $this->secret= config('secret');
        $this->is_no = config('is_no');

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
                //根据code 获取access_token
                $access_token =$this->get_accessToken($code);
                if($this->is_no){
                    $openid =$access_token['openid'];
                    Session::set('openid',$openid);
                    return $openid;
                }else{
                    $data       =$this->get_userInfo($access_token['access_token'],$access_token['openid']);
                    $headimgurl =$data['headimgurl'];
                    $nickname   =$data['nickname'];
                    Session::set('nickname',$nickname);
                    Session::set('headimgurl',$headimgurl);
                }
            }else{   //没拿到code， 就去微信拿code
                $this->get_code();
            }
        }
    }

    //获取微信code
    public function get_code(){
        if($this->is_no){
            $snope ='snsapi_base';
        }else{
            $snope ='snsapi_userinfo';
        }
        $redirect  ='http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'&response_type=code&scope='.$snope.'&state=STATE#wechat_redirect';
        $url       ='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->appid.'&redirect_uri='.$redirect;
        $url       =urlencode($url);
        var_dump($url);
        $code      =http_content($url);
        var_dump($code);die;
    }



    //获取access_token   (跟微信其他的功能的access_token 不是同一个)
    public function get_accessToken($code){
        $url  ='https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->appid.'&secret='
                .$this->secret.'&code='.$code.'&grant_type=authorization_code';
        $access_token  =curl_https($url);
        return $access_token;
    }


    //scope 为snsapi_userinfo 时 ，获取用户头像和昵称
    public function get_userInfo($accss_token,$openid){
        $url  ='https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid;
        $data =curl_https($url);
        return $data;
    }
}
