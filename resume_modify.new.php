<?php
/**
 * Created by PhpStorm.
 * User: cyx
 * Date: 2018-05-09
 * Time: 18:03
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
try {
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=fangtangdb', 'root', 'root');
//设置PDO报错详情，不然默认的是什么也不做，这样设置后会检测到PDO连接错误信息
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM `resume` WHERE `id` = ? LIMIT 1";
    $sth = $dbh->prepare($sql);
    $ret = $sth->execute([$id]);
    $resume = $sth->fetch(PDO::FETCH_ASSOC);

    if($resume['uid'] != $_SESSION['uid']) die("只能修改自己的简历");

}
catch (Exception $exception)
{
    die($exception->getMessage());
}
?><!doctype html>
<html lang="zh-cn">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
      <link rel="stylesheet" href="https://bootswatch.com/4/solar/bootstrap.min.css" >

      <link rel="stylesheet" type="text/css" media="screen" href="app.css" />


      <title>修改简历</title>

  </head>
    <body>
    <!--页面内容区域-->
    <div class="container">

        <div class="page-box">
            <h1 class="page-title">修改简历</h1>
            <form action="resume_update.php" id="form_resume" method="post" onsubmit="send_form('form_resume');return false;">
                <div id="form_resume_notice" class="form_info"></div>
                <div class="form-group">
                    <input type="text" name="title" placeholder="简历名称" class="form-control" value="<?=$resume['title'];?>"/>                </div>
                <div class="form-group">
                    <textarea rows="10" name="content" id="" class="form-control" placeholder="写入简历内容，支持 Markdown 语法"><?=htmlspecialchars($resume['content']);?></textarea>
                </div>
                <input type="hidden" name="id" value="<?=$resume['id'];?>"/>
                <div class="form-group">
                    <input type="submit" value="更新简历" class="btn btn-primary">&nbsp;
                    <input type="button"  value="返回" class="btn btn-outline-secondary float-right" onclick="history.back(1);void(0); ">
                </div>
            </form>
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