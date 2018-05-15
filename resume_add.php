<?php
//session_star之前不能有任何的输出
session_start();
if(intval($_SESSION['uid']) < 1)
{
    header("Location:user_login.php");
    die("请先<a href='user_login.php'>登入</a>再添加简历");
}
?><!doctype html>
<html lang="zh-cn">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<!-- 添加bootstrap4的基本样式，只需要引入一个css文件即可：     -->
      <link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css" >

      <link rel="stylesheet" type="text/css" media="screen" href="app.css" />


      <title>添加简历</title>

  </head>
    <body>
    <!--页面内容区域-->
    <div class="container">

        <div class="page-box">
            <h1 class="page-title">添加简历</h1>
            <form action="resume_save.php" id="form_resume" method="post" onsubmit="send_form('form_resume');return false;">
                <div id="form_resume_notice" class="form_info"></div>
                <div class="form-group">
                    <input type="text" name="title" placeholder="简历名称" class="form-control" value=""/>                </div>
                <div class="form-group">
                    <textarea rows="10" name="content" id="" class="form-control" placeholder="写入简历内容，支持 Markdown 语法"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="保存简历" class="btn btn-primary">&nbsp;
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