<?php
/**
 * Created by PhpStorm.
 * User: cyx
 * Date: 2018-05-10
 * Time: 14:47
 */
//删除session转向首页：
session_start();

//unset($_SESSION);不能用这种方法删除session，因为他是特殊的数组，是删不掉的。我们需要做的是删除S_SESSION这个数组中的对应的值，而不是删除数组
foreach ($_SESSION as $key=>$value)
{
    unset($_SESSION[$key]);
}
header("Location: index.php");