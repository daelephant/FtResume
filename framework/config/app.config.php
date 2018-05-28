<?php
/**
 * Created by PhpStorm.
 * User: cyx
 * Date: 2018-05-15
 * Time: 14:55
 */
$GLOBALS['FFCONFIG']['MYSQL_HOST'] = '127.0.0.1';
$GLOBALS['FFCONFIG']['MYSQL_USER'] = 'root';
$GLOBALS['FFCONFIG']['MYSQL_PASSWORD'] = 'root';
$GLOBALS['FFCONFIG']['MYSQL_DBNAME'] = 'fangtangdb';
$GLOBALS['FFCONFIG']['MYSQL_PORT'] = 3306;
$GLOBALS['FFCONFIG']['DSN'] = 'mysql:host=' . $GLOBALS['FFCONFIG']['MYSQL_HOST'] . ';port=' . $GLOBALS['FFCONFIG']['MYSQL_PORT'] . ';dbname='.$GLOBALS['FFCONFIG']['MYSQL_DBNAME'];
//如用到c函数，要保证C函数所在的文件先加载。否则报错

//以后new PDO的时候直接调用这一句即可
// $dbh = new PDO(c('DSN'), c('MYSQL_USER'), c('MYSQL_PASSWORD'));