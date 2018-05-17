<?php
/**
 * Created by PhpStorm.
 * User: da
 * Date: 18/5/17
 * Time: 06:50
 */
function active_class($link)
{
    if($link == ltrim($_SERVER['SCRIPT_NAME'],'/')){
        return " active ";
    }
}

//
function c( $key )
{
    return isset( $GLOBALS['FFCONFIG'][$key] ) ? $GLOBALS['FFCONFIG'][$key] : false;
}