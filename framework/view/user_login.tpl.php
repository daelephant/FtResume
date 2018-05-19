<!doctype html>
<html lang="zh-cn">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" media="screen" href="app.css" />


      <title>用户登入</title>

  </head>
    <body>
    <!--页面内容区域-->
    <div class="container">
        <div class="page-box">
            <h1 class="page-title"><?php echo $title;?></h1>
            <form action="_enter.php?m=user&a=login_check" id="form_login" method="post" onsubmit="send_form('form_login');return false;">
                <div id="form_login_notice" class="form_info"></div>
                <div class="form-group">
                    <input type="text" name="email" placeholder="Email" class="form-control"/>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="密码" class="form-control" />
                </div>
                <div class="form-group">
                    <input type="submit" value="登入" class="btn btn-primary">
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
<!--    引入CDN的js库，引入大站点的会避免加载js直接用缓存-->
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
  </body>
</html>