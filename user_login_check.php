<?php
error_reporting(E_ALL & ~E_NOTICE);

// 获取输入参数,去掉左右的空白符
$email = trim( $_REQUEST['email'] );
$password = trim( $_REQUEST['password'] );

//参数检查
if(strlen($email) < 1) die("Email 地址不正确");
if(strlen($password) < 1) die("密码不能为空");
//mb_strlen()在strlen计算时，对待一个UTF8的中文字符是3个长度，所以“中文a字1符”长度是3*4+2=14,在mb_strlen计算时，选定内码为UTF8，则会将一个中文字符当作长度1来计算，所以“中文a字1符”长度是6 .
if( mb_strlen( $password ) < 6 ) die("密码不能短于6个字符");
if( mb_strlen( $password ) > 12 ) die("密码不能长于12个字符");



//filter_var()过滤函数，指定过滤规则，本次是过滤非EMAIL。
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

    $sql = "SELECT * FROM `user` WHERE `email` = ? LIMIT 1";
    $sth = $dbh->prepare($sql);
    $ret = $sth->execute([$email]);
    $user = $sth->fetch(PDO::FETCH_ASSOC);//Array ( [id] => 1 [email] => 2848278204@qq.com [password] => $2y$10$5DKq96YSEXQc4C8z54EO6.ZnK/zaPSGsva/VLp73MlWobd6iVWB2q [created_at] => 2018-05-09 10:16:54 )
   // password_verify() — 验证密码是否和散列值匹配:用户的密码/一个由 password_hash() 创建的散列值。返回布尔值
   if(!password_verify($password,$user['password']))
   {
       //用var_dump打印仅提示Array，这时候使用print_r()
       // print_r($user);
       //var_dump($user);
       die("错误的Email地址或者密码");
   }

   session_start();
   $_SESSION['email'] = $email;
   $_SESSION['uid'] = $user['id'];

   die("登入成功<script>location='resume_list.php'</script>");

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
