<?php

use Controller\SessionManager;
use Util\Util;
use DTO\CommentForPrintOut;

require_once 'classes/Util/Util.php';
Util::initRequest();

set_time_limit(0);


if(isset($_POST['pageID']) && !empty($_POST['pageID']) && isset($_POST['pageCount'])){
    $pageID = htmlentities($_POST['pageID'], ENT_QUOTES);
    $controller = \Controller\SessionManager::getController();

    while(true){
        $databaseCommentCount = $controller->getCommentCount($pageID);

        if($_POST['pageCount'] < $databaseCommentCount){
            $comment = $controller->getOneComment($pageID, $databaseCommentCount-$_POST['pageCount']-1);
            $editable = false;
            if($controller->getNicknameByID(@$_SESSION[Util::USER_SESSION_NAME]) == $comment->getNickname())
                $editable = true;

            $jsonComment = array("nickname"=>$comment->getNickname(), "date"=>$comment->getDate(), "commentMsg"=>$comment->getCommentMsg(), "editable"=>$editable);
            echo \json_encode($jsonComment);
            return;
        }

        \session_write_close();
        \sleep(1);
        \session_start();
    }

    SessionManager::storeController($controller);
}
?>