<?php

error_reporting(E_ALL & ~E_NOTICE);

// 获取输入参数,去掉左右的空白符
$email = trim( $_REQUEST['email'] );
$password = trim( $_REQUEST['password'] );
$password2 = trim( $_REQUEST['password2'] );
//参数检查
if(strlen($email) < 1) die("Email 地址不正确");
if(strlen($password) < 1) die("密码不能为空");
if( mb_strlen( $password ) < 6 ) die("密码不能短于6个字符");
if( mb_strlen( $password ) > 12 ) die("密码不能长于12个字符");
if(strlen($password2) < 1) die("请再次输入密码，并不能为空");

if ($password != $password2) die("两次输入密码不一致");

if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    die("Email 地址错误");
}

//die("数据OK");
//连接数据库
try
{
    $dbh = new PDO('mysql:host=mysql.ftqq.com;dbname=fangtangdb', 'php', 'fangtang');
    //设置PDO报错详情，不然默认的是什么也不做，这样设置后会检测到PDO连接错误信息
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO `user` ( `email` , `password` , `created_at` ) VALUES ( ? , ? , ? )";
    $sth = $dbh->prepare($sql);
    $ret = $sth->execute([$email, password_hash($password, PASSWORD_DEFAULT), date("Y-m-d H:i:s")]);

}
catch( PDOException $Exception )
{
    $errorInfo = $sth->errorInfo();
    if( $errorInfo[1] == 1062 )
    {
        die("Email地址已被注册");
    }
    else
    {
        die( $Exception->getMessage() );
    }
}
catch( Exception $Exception )
{
    die( $Exception->getMessage() );
}