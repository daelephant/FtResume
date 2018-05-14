<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 18.5.13
 * Time: 9:49
 */
//session_star之前不能有任何的输出
session_start();
if(intval($_SESSION['uid']) < 1)
{
    header("Location:user_login.php");
    die("请先<a href='user_login.php'>登入</a>再添加简历");
}
$is_login = true;
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

<!doctype html>
<html lang="zh-cn">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" media="screen" href="app.css" />


      <title>我的简历</title>

  </head>
    <body>
    <!--页面内容区域-->
    <div class="container">
        <?php include 'header.php';?>
            <h1 class="page-title">我的简历</h1>
            <div class="page-box">
            <?php if($resume_list):?>
                <ul class="list-group">
                    <?php foreach ($resume_list as $item):?>
                        <li id="rlist-<?=$item['id'];?>" class="list-group-item list-group-item-action">
<!--                            <span class="menu-square-large" ></span>-->
                            <a href="resume_detail.php?id=<?=$item['id'];?>" class="btn btn-light" target="_blank"><?=$item['title']?></a>
                            <a href="resume_detail.php?id=<?=$item['id'];?>" target="_blank"><img src="image/open_in_new.png" alt="查看"></a>
                            <a href="resume_modify.php?id=<?=$item['id'];?>"><img src="image/mode_edit.png" alt="编辑"></a>
                            <a data-toggle="modal" data-target="#exampleModal" data-whatever="<?=$item['id'];?>" data-whatever1="<?=$item['title'];?>" href="javascript:confirm_delete('<?=$item['id'];?>');void(0);"><img src="image/close.png" alt="删除"></a>
                        </li>
                    <?php endforeach;?>
                </ul>
            <?php endif;?>
            <p><a href="resume_add.php" class="resume_add btn btn-light"><img src="image/add.png" alt="添加简历"> 添加简历</a> </p>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">大象温馨提示：</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        您确定要删除本条简历么？
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">取消</button>
                        <button onclick="confirm_delete()" type="button" class="btn btn-primary"  data-dismiss="modal">确定删除</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--页面内容区域-->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    <script src="main.js"></script>
    </body>
</html>