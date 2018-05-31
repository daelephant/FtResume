<?php
if( !defined('DS') ) define( 'DS' , DIRECTORY_SEPARATOR );//处理路径符号win和linux  / \
define("ROOT",__DIR__ .DS. '..'.DS.'..');//在所有地方用ROOT常量代表web的根
define( "FROOT" , ROOT. DS . "framework" );
define( "VIEW" , FROOT. DS . "view" );

include ROOT.DS.'vendor'.DS.'autoload.php';//

class UserTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $GLOBALS['User'] = 'yin';
        //$this->assertEquals(g('User','yin'));
        $this->assertFalse(g('User1'));

    }

    public function testUserlogin()
    {
        $_REQUEST['email'] = '2224168716@qq.com';
        $_REQUEST['password'] = 'hello';

        $user = new FangFrame\Controller\User();
        try
        {
            $user->login_check();
        }
        catch(Exception $e)
        {
            $this->assertEquals("密码不能短于6个字符",$e->getMessage());
        }

    }
}