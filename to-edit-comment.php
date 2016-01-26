<?php
use Controller\SessionManager;
use Controller\Controller;
use Util\Util;

require_once 'classes/Util/Util.php';
Util::initRequest();

$messageToUser = "";
$controller = SessionManager::getController();
$oldMessage = "";

if(isset($_SESSION[Util::USER_SESSION_NAME]) && isset($_POST['commentTime']) && isset($_POST['pageID'])) {
    try {
        $oldMessage = $controller->getCommentMsgForEdit(
            $_SESSION[Util::USER_SESSION_NAME],
            htmlentities($_POST['commentTime'], ENT_QUOTES),
            htmlentities($_POST['pageID'], ENT_QUOTES)
        );
        $_GET['page'] = 'editcomment';
    }catch (\Exceptions\CustomException $ex){
        $messageToUser = "<p class = 'negativeMessageBox'>$ex->getMessage()</p>";
        $_GET['page'] = $_SESSION['pageId'];
    }catch (\mysqli_sql_exception $ex){
        $messageToUser = "<p class = 'negativeMessageBox'>An error in connection with database occurred! Please contact administration of this website.</p>";
        $_GET['page'] = $_SESSION['pageId'];
    }finally{
        SessionManager::storeController($controller);
    }
}

include Util::VIEWS_PATH."redirect.php";
?>