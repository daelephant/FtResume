<?php
/**
 * Created by PhpStorm.
 * User: da
 * Date: 18/5/17
 * Time: 07:04
 * class最好和文件名保持相同,因为composer定义了psr-4自动加载规则"FangFrame\\Controller\\":"framework/controller/"
 */
namespace FangFrame\Controller;
class User
{
    public function login()
    {
//        echo "login";
        render([]);
    }
}