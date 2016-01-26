<?php
namespace Integration;

use DTO\CommentForPrintOut;
use Exceptions\CustomException;
use Integration\DBAccess;
use Model\Comment;

/**
 * This class handles database requests about comments
 * @package Integration
 */
class CommentDAO{
    const DB_NAME = 'tasty_recipes';
    const ID_COL = 'id';
    const TABLE_NAME = 'comments';
    const USER_ID_COL = 'userID';
    const DATE_COL = 'date';
    const COMMENT_COL = 'comment';
    const PAGE_ID_COL = 'formID';

    private $connect;

    /**
     * Constructor - establishes connection to a database when object is created
     */
    public function __construct(){
        $this->connect = new \mysqli(DBAccess::DB_LOCATION, DBAccess::DB_USER, DBAccess::DB_PASS, self::DB_NAME);
    }

    /**
     * Destructor - closes connection to the database as soon as there are no references to this object
     */
    public function __destructor(){
        $this->connect->close();
    }

    /**
     * This method stores new comment into database
     * @param Comment $comment
     */
    public function storeCommentInDB(Comment $comment){
        $query = $this->connect->prepare("INSERT INTO `".self::TABLE_NAME."` VALUES('', ?, ?, ?, ?)");
        $query->bind_param("ssss",
            $this->escape_string($comment->getUserID()),
            $this->escape_string($comment->getDate()),
            $this->escape_string($comment->getCommentMsg()),
            $this->escape_string($comment->getPageID()));
        $query->execute();
    }

    /**
     * This method updates already written comment and its date in database
     * @param Comment $editedComment
     * @param mixed $oldTimestamp
     */
    public function editCommentInDB(Comment $editedComment, $oldTimestamp){
        $query = $this->connect->prepare("UPDATE `".self::TABLE_NAME."` SET `".self::COMMENT_COL."` = ? , `".self::DATE_COL."` = ? WHERE `".self::USER_ID_COL."` = ? AND `".self::DATE_COL."` = ? AND `".self::PAGE_ID_COL."` = ?");
        $query->bind_param("sssss",
            $this->escape_string($editedComment->getCommentMsg()),
            $this->escape_string($editedComment->getDate()),
            $this->escape_string($editedComment->getUserID()),
            $this->escape_string($oldTimestamp),
            $this->escape_string($editedComment->getPageID()));
        $query->execute();
    }


    /**
     * This method returns an array that contains all comments for a specific pageID
     * @param mixed $pageID
     * @return array
     */
    public function getComments($pageID){
        $commentsArray = array();
        $query = $this->connect->prepare("SELECT users.username, `".self::DATE_COL."`, `".self::COMMENT_COL."` FROM `".self::TABLE_NAME."` LEFT JOIN `users` ON ".self::TABLE_NAME.".".self::USER_ID_COL." = users.".self::USER_ID_COL." WHERE `".self::PAGE_ID_COL."` = ? ORDER BY `".self::DATE_COL."` DESC");
        $query->bind_param('s', $this->escape_string($pageID));
        $query->execute();
        $query->bind_result($nickname, $date, $commentMsg);
        while ($query->fetch()) {
            $commentsArray[] = new CommentForPrintOut($nickname, $date, $commentMsg);
        }

        return $commentsArray;
    }

    /**
     * @param $userID
     * @param $date
     * @param $pageID
     * @return mixed
     * @throws CustomException
     */
    public function getCommentMsgForEditFromDB($userID, $date, $pageID){
        $query = $this->connect->prepare("SELECT `".self::COMMENT_COL."` FROM `".self::TABLE_NAME."` WHERE `".self::USER_ID_COL."` = ? AND `".self::DATE_COL."` = ? AND `".self::PAGE_ID_COL."` = ?");
        $query->bind_param('sss', $this->escape_string($userID), $this->escape_string($date), $this->escape_string($pageID));
        $query->execute();
        $query->bind_result($commentMsg);
        $query->fetch();

        if(sizeof($commentMsg) == 1)
            return $commentMsg;
        else
            throw new CustomException("You are trying to edit a message that you should not be able to change!");
    }

    /**
     * This method gets count of comments in database for specific pageID
     * @param $pageID
     * @return int
     */
    public function getCommentsCountInDB($pageID){
        $query = $this->connect->prepare("SELECT `".self::ID_COL."` FROM `".self::TABLE_NAME."` WHERE `".self::PAGE_ID_COL."` = ?");
        $query->bind_param('s', $this->escape_string($pageID));
        $query->execute();
        $query->store_result();

        return $query->num_rows;
    }

    /**
     * @param $pageID
     * @param $offset
     * @return CommentForPrintOut
     */
    public function getOneCommentByLimitIndexInDB($pageID, $offset){//SELECT * FROM `comments` WHERE `formID` = 'swemeatballs' ORDER BY `id` DESC LIMIT 1 OFFSET 1
        $query = $this->connect->prepare("SELECT users.username, `".self::DATE_COL."`, `".self::COMMENT_COL."` FROM `".self::TABLE_NAME."` LEFT JOIN `users` ON ".self::TABLE_NAME.".".self::USER_ID_COL." = users.".self::USER_ID_COL." WHERE `".self::PAGE_ID_COL."` = ?  ORDER BY comments.".self::ID_COL." DESC LIMIT 1 OFFSET ?");
        $query->bind_param('si', $this->escape_string($pageID), $offset);
        $query->execute();
        $query->bind_result($nickname, $date, $commentMsg);
        $query->fetch();

        return new CommentForPrintOut($nickname, $date, $commentMsg);
    }

    private function escape_string($param){
        return $this->connect->real_escape_string($param);
    }
}
?>