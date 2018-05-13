<?php
/**
 * Created by PhpStorm.
 * User: cyx
 * Date: 2018-05-09
 * Time: 18:44
 */
//session_star之前不能有任何的输出
session_start();
if(intval($_SESSION['uid']) < 1)
{
    header("Location:user_login.php");
    die("请先<a href='user_login.php'>登入</a>再添加简历");
}

$id = intval($_REQUEST['id']);
if($id<1) die("错误的简历ID");

//连接数据库
try
{
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=fangtangdb', 'root', 'root');
    //设置PDO报错详情，不然默认的是什么也不做，这样设置后会检测到PDO连接错误信息
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE `resume` SET `is_deleted` = 1 , `title` = CONCAT(`title` , ?)  WHERE `id` = ? AND `uid` = ? LIMIT 1";
    $sth = $dbh->prepare($sql);
    $ret = $sth->execute([ '_DEL_'.time() , $id , intval($_SESSION['uid'])]);
    //header("Location:user_login.php");
    //die("简历删除成功！<script>location='resume_list.php'</script>");
    //die("简历删除成功！<script>location.reload();</script>");
    die("done");
}
//因为是删除操作，直接把所有信息直接打印出来
catch( Exception $Exception )
{
    die( $Exception->getMessage() );
}
