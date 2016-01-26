<?php
namespace DTO;

class CommentForPrintOut{
    private $nickname;
    private $date;
    private $commentMsg;

    /**
     * MessageOutData constructor.
     * @param $nickname
     * @param $date
     * @param $commentMsg
     */
    public function __construct($nickname, $date, $commentMsg){
        $this->nickname = $nickname;
        $this->date = $date;
        $this->commentMsg = $commentMsg;
    }

    /**
     * A getter for comment nickname
     * @return mixed
     */
    public function getNickname(){
        return $this->nickname;
    }

    /**
     * A getter for comment date
     * @return mixed
     */
    public function getDate(){
        return $this->date;
    }

    /**
     * A getter for comment message
     * @return mixed
     */
    public function getCommentMsg(){
        return $this->commentMsg;
    }
}
?>