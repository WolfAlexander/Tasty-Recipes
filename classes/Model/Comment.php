<?php
namespace Model;

use Integration\CommentDAO;

class Comment{
    private $userID;
    private $commentMsg;
    private $date;
    private $pageID;

    /**
     * Comment constructor.
     * @param $userID
     * @param $commentMsg
     * @param $pageID
     */
    public function __construct($userID, $commentMsg, $pageID){
        $this->userID = $userID;
        $this->commentMsg = $commentMsg;
        $datetime = new \DateTime();
        $this->date = $datetime->format('Y-m-d H:i:s');
        $this->pageID = $pageID;
    }

    /**
     * This method sends comment to database handler
     */
    public function store(){
        $commentDAO = new CommentDAO();
        $commentDAO->storeCommentInDB($this);
    }

    /**
     * This function sends edited comment for updating to database
     */
    public function edit($oldTimestamp){
        $commentDAO = new CommentDAO();
        $commentDAO->editCommentInDB($this, $oldTimestamp);
    }

    /**
     * A getter for nickname
     * @return mixed
     */
    public function getUserID(){
        return $this->userID;
    }

    /**
     * A getter for comment message
     * @return mixed
     */
    public function getCommentMsg(){
        return $this->commentMsg;
    }

    /**
     * A getter for comment date
     * @return string
     */
    public function getDate(){
        return $this->date;
    }

    /**
     * A getter for pageID
     * @return mixed
     */
    public function getPageID(){
        return $this->pageID;
    }
}
?>