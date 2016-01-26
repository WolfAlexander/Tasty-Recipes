<?php
namespace View;

use \Controller\SessionManager;
use \Util\Util;
use \Exceptions\CustomException;

require_once 'classes/Util/Util.php';
Util::initRequest();

$messageToUser = "";
$controller = "";

if(isset($_POST['loginName']) && isset($_POST['loginPassword']) && !isset($_POST[Util::USER_SESSION_NAME])){
    if(!empty($_POST['loginName']) && !empty($_POST['loginPassword'])){
        $loginName = htmlentities($_POST['loginName'], ENT_QUOTES);
        $loginPassword = htmlentities($_POST['loginPassword'], ENT_QUOTES);

        try{
            $controller = SessionManager::getController();
            $controller->loginUser($loginName, $loginPassword);
            $messageToUser = "<p class = 'positiveMessageBox'>You are logged in! :) Welcome!</p>";
        }catch(CustomException $ex){
            $messageToUser = "<p class = 'warningMessageBox'>".$ex->getMessage()."</p>";
        }catch(\mysqli_sql_exception $ex){
            $messageToUser = "<p class = 'negativeMessageBox'>An error in connection with database occurred! Please contact administration of this website.</p>";
        }finally{
            SessionManager::storeController($controller);
        }
    }else{
        $messageToUser = "<p class = 'warningMessageBox'>Both nickname field and password field have to be filled! Try again!</p>";
    }
}

@$_GET['page'] = $_SESSION['pageId'];
include Util::VIEWS_PATH."redirect.php";
?>