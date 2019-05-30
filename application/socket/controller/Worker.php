<?php
namespace app\socket\controller;

use think\worker\server;

class Worker extends server
{
    protected $socket ='websocket://0.0.0.0:8282';

    //连接回调函数
    public function onConnect(){

    }

    //发消息回调函数
    public function onMessage(){

    }


    //关闭回调函数
    public function onClose(){

    }
}
