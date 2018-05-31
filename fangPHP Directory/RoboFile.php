<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    // define public methods as commands
    /**
    * show jscpd dif1
    */
    public function find_dfiles()
    {
    	$this->_exec('jscpd --files="data/web/FtResume/*.php"');
    }

}