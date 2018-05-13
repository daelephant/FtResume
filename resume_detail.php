<?php
/**
 * Created by PhpStorm.
 * User: cyx
 * Date: 2018-05-09
 * Time: 17:44
 */
//展示页面所有人都可以看到，所以不需要验证session
$id = intval($_REQUEST['id']);
if($id<1) die("错误的简历ID");

//连接数据库
try {
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=fangtangdb', 'root', 'root');
//设置PDO报错详情，不然默认的是什么也不做，这样设置后会检测到PDO连接错误信息
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM `resume` WHERE `id` = ? LIMIT 1";
    $sth = $dbh->prepare($sql);
    $ret = $sth->execute([$id]);
    $resume = $sth->fetch(PDO::FETCH_ASSOC);
    //print_r($id);

}
catch (Exception $exception)
{
    die($exception->getMessage());
}

include 'lib/Parsedown.php';
$md = new Parsedown();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$resume['title'];?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <!--引入CDN的js库，引入大站点的会避免加载js直接用缓存   -->
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="content">
            <?=$md->text($resume['content']);?>
        </div>

    </div>
</body>
</html>
