<?php
namespace View;

use \Controller\SessionManager;
use \Util\Util;
use \Exceptions\CustomException;

require_once 'classes/Util/Util.php';
Util::initRequest();

$messageToUser = "<p class = 'negativeMessageBox'>An error!</p>";
$controller = SessionManager::getController();

if(isset($_POST['comment'])){
    if(!empty($_POST['comment'])){
        $comment = htmlentities($_POST['comment'], ENT_QUOTES);

        try{
            $controller->leaveComment($_SESSION[Util::USER_SESSION_NAME], $comment, $_POST['pageID']);
            $messageToUser = "<p class = 'positiveMessageBox'>Comment is successfully posted! :)</p>";
        }catch(CustomException $ex){
            $messageToUser = "<p class = 'warningMessageBox'>".$ex->getMessage()."</p>";
        }catch(\mysqli_sql_exception $ex){
            $messageToUser = "<p class = 'negativeMessageBox'>An error in connection with database occurred! Try again and please contact administration of this website.</p>";
        }finally{
            SessionManager::storeController($controller);
        }
    }else{
        $messageToUser = "<p class = 'warningMessageBox'>You cannot post empty comment! Enter some text. :)</p>";
    }
}

echo \json_encode($messageToUser);
?>