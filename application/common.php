<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


//curl get方式
 function curl_get($url){
    $curl = curl_init();
         //设置抓取的url
    curl_setopt($curl, CURLOPT_URL, $url);
      //设置头文件的信息作为数据流输出
    curl_setopt($curl, CURLOPT_HEADER, 0);
      //设置获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      //执行命令
    $data = curl_exec($curl);
     //关闭URL请求
    curl_close($curl);
     //显示获得的数据
     $data =json_decode($data);
     return $data;
 }

//curl get方式(https)
function curl_https($url){
    $curl = curl_init();
    //设置抓取的url
    curl_setopt($curl, CURLOPT_URL, $url);
    //设置头文件的信息作为数据流输出
    curl_setopt($curl, CURLOPT_HEADER, 0);
    //设置获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    //执行命令
    $data = curl_exec($curl);
    //关闭URL请求
    curl_close($curl);
    //显示获得的数据
    $data =json_decode($data,true);
    return $data;
}

//file_get_content   抓取链接信息
function http_content($url){
     $data =file_get_contents($url);
    $data =json_decode($data,true);
    return $data;
}


//curl post 方式
function curl_post($data,$url){
    $curl = curl_init();
    //设置抓取的url
    curl_setopt($curl, CURLOPT_URL, $url);
    //设置头文件的信息作为数据流输出
    curl_setopt($curl, CURLOPT_HEADER, 1);
    //设置获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //设置post方式提交
    curl_setopt($curl, CURLOPT_POST, 1);
    //设置post数据
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    //执行命令
     $data = curl_exec($curl);
     //关闭URL请求
     curl_close($curl);
     //显示获得的数据
    $data =json_decode($data);
    return $data;
}


