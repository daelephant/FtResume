<?php
/**
 * Created by PhpStorm.
 * User: da
 * Date: 18/5/17
 * Time: 06:52
 */

$GLOBALS['FFCONFIG']['MYSQL_HOST'] = 'mysql.ftqq.com';
$GLOBALS['FFCONFIG']['MYSQL_USER'] = 'php';
$GLOBALS['FFCONFIG']['MYSQL_PASSWORD'] = 'fangtang';
$GLOBALS['FFCONFIG']['MYSQL_DBNAME'] = 'fangtangdb';
$GLOBALS['FFCONFIG']['MYSQL_PORT'] = 3306;
$GLOBALS['FFCONFIG']['DSN'] = 'mysql:host=' . $GLOBALS['FFCONFIG']['MYSQL_HOST'] . ';port=' . $GLOBALS['FFCONFIG']['MYSQL_PORT'] . ';dbname='.$GLOBALS['FFCONFIG']['MYSQL_DBNAME'];


//将来可以直接使用定义的读取配置文件的c函数直接调用上述配置项信息，详情查看c函数,依赖：使用的时候注意c函数所在的文件要先载入，否则报错
// $dbh = new PDO(c('DSN'), c('MYSQL_USER'), c('MYSQL_PASSWORD'));