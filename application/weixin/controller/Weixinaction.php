<?php
namespace app\weixin\controller;

use think\Controller;
use think\Config;
use think\Exception;
use think\Request;
use think\Session;


class Weixinaction extends Controller
{
    private  $appid;
    private  $secret;
    private  $Redis ;
    public function _initialize(){
        $this->appid  =config('appid');
        $this->secret =config('secret');

    }


    public function get_AccessToken(){
        $this->Redis  =new Redis();
        $access =$this->Redis->get('access_token_'.$this->appid);
        if(!$access){
            var_dump($this->appid);
            $url ='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appid.'&secret='.$this->secret;
            $data=curl_https($url);
            if($data['access_token']){
                $this->Redis->setex('access_token_'.$this->appid,'7200',$data['access_token']);
                return ['access_token'=>$data['access_token']];
            }else{
                throw new Exception('获取access_token失败'.$data);
            }
        }else{
            return ['access_token'=>$access];
        }
    }




}
