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

function g( $key )
{
    return isset( $GLOBALS[$key] ) ? $GLOBALS[$key] : false;
}

function v( $key )
{
    return isset( $_REQUEST[$key] ) ? $_REQUEST[$key] : false;
}

function e($message)
{
    throw new Exception($message);
}

function render($data,$template=null)
{
    if($html = get_render_content($data,$template)) echo $html;
}

function get_render_content($data,$template=null)
{
    if($template == null) $template = VIEW.DS. g('m') .'_'. g('a') . '.tpl.php';
    if(!file_exists($template))
    {
        throw new Exception("模板不存在！".$template);
        return false;
    }

    ob_start();

    //extract() 函数从数组中将变量导入到当前的符号表。 该函数使用数组键名作为变量名,使用数组键值作为变量值。z
    extract($data);
    require $template;
    $out = ob_get_contents();//获取缓存区的数据
    ob_end_clean();

    return $out;

//    不想直接输出，返回的可控性会更高，在php里面处理session和cookie时，如果有突然输出，那么其他地方header就没法往上加了
//    所以这里就需要把输出捕捉到，再返回回去。php提供了这样的函数ob——start。把输出放到缓冲区
}


//全局只实例化一个PDO对象
function pdo()
{
    if(!isset($GLOBALS['FF_PDO']))
    {

        $GLOBALS['FF_PDO'] = new PDO(c('DSN'), c('MYSQL_USER'), c('MYSQL_PASSWORD'));
        //设置PDO报错详情，不然默认的是什么也不做，这样设置后会检测到PDO连接错误信息
        if($GLOBALS['FF_PDO']) $GLOBALS['FF_PDO']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    return $GLOBALS['FF_PDO'];
}

//数据查询
function get_data($sql,$data=null)
{
    $pdo = pdo();
    $sth = $pdo->prepare($sql);
    $ret = $sth->execute($data);
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}

