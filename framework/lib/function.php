<?php
/**
 * Created by PhpStorm.
 * User: cyx
 * Date: 2018-05-15
 * Time: 14:52
 */
function active_class($link)
{
    if($link == ltrim($_SERVER['SCRIPT_NAME'],'/')){
        return " active ";
    }
}

//定义读取配置文件中全局变量
function c( $key )
{
    return isset( $GLOBALS['FFCONFIG']['$key'] ) ? $GLOBALS['FFCONFIG']['$key'] : false;
}