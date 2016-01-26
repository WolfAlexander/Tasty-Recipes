<?php
namespace View;

use \Controller\SessionManager;
use Integration\DBAccess;
use \Util\Util;
use \Exceptions\CustomException;

require_once 'classes/Util/Util.php';
Util::initRequest();

$controller = "";

if(isset($_SESSION[Util::USER_SESSION_NAME]) && isset($_POST['editedComment']) && isset($_POST['pageID'])){
    if(!empty($_POST['editedComment']) && !empty($_POST['pageID']) && !empty($_POST['oldCommentTime'])){
        $editedComment = htmlentities($_POST['editedComment'], ENT_QUOTES);

        try{
            $controller = SessionManager::getController();
            $controller->editComment($editedComment, $_POST['pageID'], $_POST['oldCommentTime']);
            $messageToUser = array("error"=>false, "message"=>"<p class = 'positiveMessageBox'>Comment is successfully edited! :)</p>");
        }catch(CustomException $ex){
            $messageToUser = array("error"=>true, "message"=>"<p class = 'warningMessageBox'>".$ex->getMessage()."</p>");
        }catch(\mysqli_sql_exception $ex) {
            $messageToUser = array("error"=>true, "message"=>"<p class = 'negativeMessageBox'>An error in connection with database occurred! Please contact administration of this website</p>");
        }finally{
            SessionManager::storeController($controller);
        }
    }else{
        $messageToUser = array("error"=>true, "message"=>"<p class = 'warningMessageBox'>You cannot edit your comment to an empty comment!</p>");
    }
}

echo \json_encode($messageToUser);
?>