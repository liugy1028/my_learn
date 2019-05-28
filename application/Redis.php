<?php
namespace app;

use think\Exception;
use think\Controller;
class Redis  extends  Controller
{

    private $redis;
    public function _initialize(){
        $this->redis  =new \Redis();
        $con    =$this->redis  ->connect('127.0.0.1','6379');
        if(!$con){
            throw  new Exception('redis 连接失败');
        }
    }

    //@name  设置的字符串名
    //@value 设置的值
    public function set($name,$value){
        $this->redis->set($name,$value);
    }


    //设置字符串 生效时间
    //$time (int)
    public function setEx($name,$value,$time){
        $this->redis->setex($name,$time,$value);
    }


    //@name   要查找的字符串名
    public function get($name){
        $data  =$this->redis->get($name);
        return $data;
    }

}

