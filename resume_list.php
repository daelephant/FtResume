<?php
//session_star之前不能有任何的输出
session_start();
if(intval($_SESSION['uid']) < 1)
{
    header("Location:user_login.php");
    die("请先<a href='user_login.php'>登入</a>再添加简历");
}

//连接数据库
try {
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=fangtangdb', 'root', 'root');
//设置PDO报错详情，不然默认的是什么也不做，这样设置后会检测到PDO连接错误信息
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT `id`,`uid`,`title`,`created_at` FROM `resume` WHERE `uid` = ?  AND `is_deleted` != 1";
    $sth = $dbh->prepare($sql);
    $ret = $sth->execute([intval($_SESSION['uid'])]);
    $resume_list = $sth->fetchAll(PDO::FETCH_ASSOC);//二维数组
    //print_r($resume_list);

}
catch (Exception $exception)
{
    die($exception->getMessage());
}
//exit;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>我的简历</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <!--引入CDN的js库，引入大站点的会避免加载js直接用缓存   -->
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>我的简历</h1>
        <?php if($resume_list):?>
        <ul class="resume_list">
            <?php foreach ($resume_list as $item):?>
                <li>
                    <a href="resume_detail.php?id=<?=$item['id'];?>" class="title middle" target="_blank"><?=$item['title']?></a>
                    <a href="resume_detail.php?id=<?=$item['id'];?>" target="_blank"><img src="image/open_in_new.png" alt="查看"></a>
                    <a href="resume_modify.php?id=<?=$item['id'];?>"><img src="image/mode_edit.png" alt="编辑"></a>
                    <a href="javascript:confirm_delete('<?=$item['id'];?>');void(0);"><img src="image/close.png" alt="删除"></a>
                </li>
            <?php endforeach;?>
        </ul>
        <?php endif;?>
        <p><a href="resume_add.php" class="resume_add"><img src="image/add.png" alt="添加简历"> 添加简历</a> </p>
    </div>
</body>
</html>