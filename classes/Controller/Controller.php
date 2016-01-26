<?php
namespace Controller;

use DTO\LoginData;
use DTO\RegisterData;
use Integration\CommentDAO;
use Integration\UserDAO;
use Model\Comment;
use Model\UserHandler;

class Controller{

    /**
     * Sends data entered by a user in registration form to UserHandler object for registration
     * @param $nickname
     * @param $real_name
     * @param $password
     * @param $password_again
     */
    public function registerNewUser($nickname, $real_name, $password, $password_again){
        $userHandler = new UserHandler();
        $userHandler->register(new RegisterData($nickname, $real_name, $password, $password_again, null, null));
    }

    /**
     * Sends data entered by a user in login form to UserHandler object for login process
     * @param $loginName
     * @param $loginPass
     */
    public function loginUser($loginName, $loginPass){
        $userHandler = new UserHandler();
        $userHandler->login(new LoginData($loginName, $loginPass));
    }

    /**
     * Send request to user handler to logout this user
     */
    public function logoutUser(){
        $userHandler = new UserHandler();
        $userHandler->logout();
    }

    /**
     * This method return all comment in CommentsForPrintOut DTO
     * @param $pageID
     * @return array
     */
    public function getComments($pageID){
        $commentDAO = new CommentDAO();
        return $commentDAO->getComments($pageID);
    }

    /**
     * Creates Comment object and calls store function
     * @param $userID
     * @param $commentMsg
     * @param $pageID
     */
    public function leaveComment($userID, $commentMsg, $pageID){
        $comment = new Comment($userID, $commentMsg, $pageID);
        $comment->store();
    }


    /**
     * This method redirects data to editing method in Comment object
     * @param $commentMsg
     * @param $pageID
     * @param $oldTimeStamp
     */
    public function editComment($commentMsg, $pageID, $oldTimeStamp){
        $comment = new Comment($_SESSION['tastyRecipeUser'], $commentMsg, $pageID);
        $comment->edit($oldTimeStamp);
    }

    /**
     * This method gets users nickname
     * @param $userID
     * @return mixed
     */
    public function getNicknameByID($userID){
        $userDAO = new UserDAO();
        return $userDAO->getNicknameByIDFromDB($userID);
    }

    /**
     * This method gets one comment message
     * @param $userID
     * @param $date
     * @param $pageID
     * @return mixed
     */
    public function getCommentMsgForEdit($userID, $date, $pageID){
        $commentDAO = new CommentDAO();
        return $commentDAO->getCommentMsgForEditFromDB($userID, $date, $pageID);
    }

    /**
     * This method gets count of comments for specific pageID
     * @param $pageID
     * @return int value that is the count of comments
     */
    public function getCommentCount($pageID){
        $commentDAO = new CommentDAO();
        return $commentDAO->getCommentsCountInDB($pageID);
    }

    /**
     * This method returns one comment
     * @param $pageID
     * @param $offset
     * @return mixed
     */
    public function getOneComment($pageID, $offset){
        $commentDAO = new CommentDAO();
        return $commentDAO->getOneCommentByLimitIndexInDB($pageID, $offset);
    }
}
?>