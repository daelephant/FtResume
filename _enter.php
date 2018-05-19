<?php
/**
 * Created by PhpStorm.
 * User: da
 * Date: 18/5/17
 * Time: 06:47
 * todo: 入口文件，主要去加载lib下面的function和config里面的配置，这里面不用require，使用composer autoloaded
 * 修改过composer配置需要重新运行composer install
 * view 模板尽量使用.php结尾的html内容文件。因为.html结尾容易导致嵌入到模板的某些数据可能会被直接访问从而暴露
 */
//定义根目录常量
//define("ROOT",dirname(__FILE__));dirname() 函数返回路径中的目录部分
//PHP版本大于等于PHP5.3.0，建议使用__DIR__,否则，最好还是用dirname(__FILE__)，以确保程序不会出错
if( !defined('DS') ) define( 'DS' , DIRECTORY_SEPARATOR );//处理路径符号win和linux  / \
define("ROOT",__DIR__);//在所有地方用ROOT常量代表web的根
define( "FROOT" , ROOT. DS . "framework" );
define( "VIEW" , FROOT. DS . "view" );

error_reporting(E_ALL ^ E_NOTICE);//入口文件设置报错机制

include 'vendor/autoload.php';//本地文件、第三方库、未来写的类都引进来了
$GLOBALS['m'] = $m = v('m') ? v('m') : 'resume';
$class = ucfirst( strtolower($m));//upper case 大写  lower case 小写 ，每个单词的首字母转换为大写：ucwords()，所有 字母变大写：strtoupper()
$GLOBALS['a'] = $a = v('a') ? v('a') : 'index';

//echo "$m > $a";

//$app = new $m;
//$app -> $a();
//在PHP里面调用一个对象的方法应该是call_user_function()函数来搞定
try{

    $controller = "FangFrame\\Controller\\".$class;
    call_user_func([new $controller(),$a]);
    //throw new Exception("error");
}
catch (Exception $e)
{
    die($e->getMessage());
}