<?php
//session_star之前不能有任何的输出
session_start();
if(intval($_SESSION['uid']) < 1)
{
    header("Location:user_login.php");
    die("请先<a href='user_login.php'>登入</a>再添加简历");
}

error_reporting(E_ALL & ~E_NOTICE);

// 获取输入参数,去掉左右的空白符
$title = trim( $_REQUEST['title'] );
$content = trim( $_REQUEST['content'] );
//参数检查
if(strlen($title) < 1) die("简历名称不能为空");
//mb_strlen()在strlen计算时，对待一个UTF8的中文字符是3个长度，所以“中文a字1符”长度是3*4+2=14,在mb_strlen计算时，选定内码为UTF8，则会将一个中文字符当作长度1来计算，所以“中文a字1符”长度是6 .
if( mb_strlen( $content ) < 10 ) die("简历内容不能少于10个字符");

//连接数据库
try
{
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=fangtangdb', 'root', 'root');
    //设置PDO报错详情，不然默认的是什么也不做，这样设置后会检测到PDO连接错误信息
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO `resume` ( `title` , `content` , `uid` , `created_at` ) VALUES ( ? , ? , ? , ? )";
    $sth = $dbh->prepare($sql);
    $ret = $sth->execute([$title, $content, intval($_SESSION['uid']) , date("Y-m-d H:i:s")]);
    //header("Location:user_login.php");
    die("简历保存成功！<script>location='resume_list.php'</script>");
}
catch( PDOException $Exception )
{
    // //用var_dump打印仅提示Array，这时候使用print_r()
    //print_r($sth->errorInfo());重复的时候key=1的值是1062，key=0的值是23000（字段名错误也是23000）

    //$Exception的getCode()不准确，有时候字段名写错，还是报23000
    //if($Exception->getCode() == 23000){
    //    die("简历名称已存在");
    //}
    $errorInfo = $sth->errorInfo();
    if( $errorInfo[1] == 1062 )
    {
        die("简历名称已存在");
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
