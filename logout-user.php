<?php
namespace View;

use \Controller\SessionManager;
use \Util\Util;
use \Exceptions\CustomException;

require_once 'classes/Util/Util.php';
Util::initRequest();

$controller = SessionManager::getController();
$controller->logoutUser();
SessionManager::storeController($controller);

$_GET['page'] = 'logout';
include Util::VIEWS_PATH."redirect.php";
?>