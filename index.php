<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 18.5.13
 * Time: 9:49
 */
//设置PHP报错机制：除了NOTICE报错其他FangFrame
error_reporting(E_ALL ^ E_NOTICE);
//session_star之前不能有任何的输出
session_start();
$is_login = intval($_SESSION['uid']) < 1 ? false:true;

//连接数据库
try {
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=fangtangdb', 'root', 'root');
//设置PDO报错详情，不然默认的是什么也不做，这样设置后会检测到PDO连接错误信息
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT `id`,`uid`,`title`,`created_at` FROM `resume` WHERE `is_deleted` != 1";
    $sth = $dbh->prepare($sql);
    $ret = $sth->execute([]);
    $resume_list = $sth->fetchAll(PDO::FETCH_ASSOC);//二维数组
    //print_r($resume_list);

}
catch (Exception $exception)
{
    die($exception->getMessage());
}
//exit;
?>

<!doctype html>
<html lang="zh-cn">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" media="screen" href="app.css" />


      <title>Elephant简历</title>

  </head>
    <body>
    <!--页面内容区域-->
    <div class="container">
        <?php include 'header.php';?>
        <div class="page-box">
            <h1 class="page-title">最新简历</h1>
            <?php if($resume_list):?>
                <ul class="list-group">
                    <?php foreach ($resume_list as $item):?>
                        <li id="rlist-<?=$item['id'];?>" class="list-group-item list-group-item-action">
<!--                            <span class="menu-square-large" ></span>-->
                            <a href="resume_detail.php?id=<?=$item['id'];?>" class="btn btn-light" target="_blank"><?=$item['title']?></a>
                            <a href="resume_detail.php?id=<?=$item['id'];?>" target="_blank"><img src="image/open_in_new.png" alt="查看"></a>

                        </li>
                    <?php endforeach;?>
                </ul>
            <?php endif;?>
        </div>
    </div>
    <!--页面内容区域-->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="main.js"></script>
  </body>
</html>