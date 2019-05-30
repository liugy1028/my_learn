<?php
namespace app\weixin\controller;

use think\Controller;
use think\Config;
use think\Exception;
use think\Request;

class Jssdk extends  Controller
{
    private $appid ;
    private $secert ;

    public function _initialize()
    {
        $this->appid =\config('appid');
        $this->secert=\config('secret');
    }


    //获取jssdk_ticket
    public function  jssdk_Ticket(){
        $redis  =new Redis();
        $jssdk_Ticket =$redis->get('ticket_'.$this->appid);
        if($jssdk_Ticket){
            return $jssdk_Ticket;
        }else{
            $access_token =$redis->get('access_token_'.$this->appid);
            if(!$access_token){
                $WeixinAction =new Weixinaction();
                $access_token =$WeixinAction->get_AccessToken();
                $access_token =$access_token['access_token'];
            }
            $url    ='https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$access_token.'&type=jsapi';
            $jssdk_Ticket =curl_https($url);
            if($jssdk_Ticket['ticket']){
                $redis->setEx('ticket_'.$this->appid,'7200',$jssdk_Ticket['ticket']);
                return $jssdk_Ticket['ticket'];
            }else{
                throw new Exception('获取jssdk_ticket 失败'.$jssdk_Ticket);
            }

        }

    }


    //随机字符串
    public function nonceStr($length=16){
        $str  = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str1 ='';
        for($i=0;$i<$length;$i++){
            $str1.=substr($str,rand(0,51),1);
        }
        return $str1;
    }
}