<?php
namespace Util;

/**
 * Utility class
 * @package Util
 */
final class Util{
    const VIEWS_PATH = 'resources/view/';
    const CSS_PATH = 'resources/css/';
    const IMG_PATH = 'resources/img/';
    const JS_PATH = 'resources/js/';
    const USER_SESSION_NAME = 'tastyRecipeUser';

    private  function __construct(){}

    /**
     * This method initialises autoload function and starts session
     * This method should should be called first in any PHP page that receiving a HTTP request
     */
    public static function initRequest(){
        \session_start();


        self::initAutoload();
    }

    private static function initAutoload(){
        spl_autoload_register(function($class) {
            require_once 'classes/' . \str_replace('\\', '/', $class) . '.php';
        });
    }
}
?>