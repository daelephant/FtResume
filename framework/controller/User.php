<?php
/**
 * Created by PhpStorm.
 * User: da
 * Date: 18/5/17
 * Time: 07:04
 * class最好和文件名保持相同,因为composer定义了psr-4自动加载规则"FangFrame\\Controller\\":"framework/controller/"
 */
namespace FangFrame\Controller;
class User
{
    public function login()
    {
        $data['title'] = "用户登入呀";
        render($data);
        //echo get_render_content($data);
    }

    public function login_check()
    {

        // 获取输入参数,去掉左右的空白符
        $email = trim(v('email'));
        $password = trim(v('password'));

        //参数检查
        if(strlen($email) < 1) e("Email 地址不正确");
        if(strlen($password) < 1) e("密码不能为空");
        //mb_strlen()在strlen计算时，对待一个UTF8的中文字符是3个长度，所以“中文a字1符”长度是3*4+2=14,在mb_strlen计算时，选定内码为UTF8，则会将一个中文字符当作长度1来计算，所以“中文a字1符”长度是6 .
        if( mb_strlen( $password ) < 6 ) e("密码不能短于6个字符");
        if( mb_strlen( $password ) > 12 ) e("密码不能长于12个字符");



        //filter_var()过滤函数，指定过滤规则，本次是过滤非EMAIL。
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            e("Email 地址错误");
        }

        if($user_list = get_data("SELECT * FROM `user` WHERE `email` = ? LIMIT 1" , [ $email ]))
        {
            $user = $user_list[0];
        }
        // password_verify() — 验证密码是否和散列值匹配:用户的密码/一个由 password_hash() 创建的散列值。返回布尔值
        if(!password_verify($password,$user['password']))
        {
            //用var_dump打印仅提示Array，这时候使用print_r()
            // print_r($user);
            //var_dump($user);
            e("错误的Email地址或者密码");
        }

        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['uid'] = $user['id'];

   die("登入成功<script>location='resume_list.php'</script>");


    }
}