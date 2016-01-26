<?php
namespace Controller;

use Controller\Controller;

/**
 * This class stores and retrieves session data
 * @package Controller
 */
class SessionManager{
    const CONTROLLER_KEY = 'controller';
    const BROWSER_COMMENT_COUNT_KEY = 'browserCommentsCount';

    private function __construct(){}

    /**
     * This method stores controller instance in the current session
     * @param \Controller\Controller $controller
     */
    public static function storeController(Controller $controller){
        $_SESSION[self::CONTROLLER_KEY] = serialize($controller);
    }

    /**
     * This method returns Controller instance
     * If Controller instance do not exists then returns new instance
     * @return \Controller\Controller
     */
    public static function getController(){
        if(isset($_SESSION[self::CONTROLLER_KEY]))
            return unserialize($_SESSION[self::CONTROLLER_KEY]);
        else
            return new Controller();
    }
}
?>