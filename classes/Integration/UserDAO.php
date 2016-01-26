<?php
namespace Integration;

use Integration\DBAccess;
use DTO\LoginData;
use Model\User;

/**
 * This class handles database requests about users
 * @package Integration
 */
class UserDAO{
    const DB_NAME = 'tasty_recipes';
    const TABLE_NAME = 'users';
    const NICKNAME_COL = 'username';
    const PASSWORD_COL = 'password';
    const USERNAME_COL = 'real_name';
    const USER_ID_COL = 'userID';

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
     * This method checks if user exists in the database
     * @param $nickname - nickname of the user
     * @return bool - returns true if user found
     */
    public function doNicknameExistInDB($nickname){
        $query = $this->connect->prepare("SELECT `".self::NICKNAME_COL."` FROM `".self::TABLE_NAME."` WHERE `".self::NICKNAME_COL."` = ?");
        $query->bind_param('s', $this->escape_string($nickname));
        $query->execute();
        $query->store_result();

        if($query->num_rows == 1)
            return true;
        else
            return false;

    }

    /**
     * This method gets and returns password corresponding to entered nickname from database
     * @param $nicknameData
     * @return - the password
     */
    public function getUserPasswordFromDB($nicknameData){
        $query = $this->connect->prepare("SELECT `".self::PASSWORD_COL."` FROM `".self::TABLE_NAME."` WHERE `".self::NICKNAME_COL."` = ?");
        $query->bind_param('s', $this->escape_string($nicknameData));
        $query->execute();
        $query->bind_result($password);
        $query->fetch();

        return $password;
    }

    /**
     * This method gets and return user id from the database
     * @param LoginData $userLoginData
     * @return mixed
     */
    public function getUserIdFromDB(LoginData $userLoginData){
        $query = $this->connect->prepare("SELECT `".self::USER_ID_COL."` FROM `".self::TABLE_NAME."` WHERE `".self::NICKNAME_COL."` = ?");
        $query->bind_param('s', $this->escape_string($userLoginData->getNickname()));
        $query->execute();
        $query->bind_result($userID);
        $query->fetch();

        return $userID;
    }

    /**
     * This method sends new users data to the database
     * @param User $registerData
     */
    public function registerNewUserInDB(User $registerData){
        $query = $this->connect->prepare("INSERT INTO `".self::TABLE_NAME."` VALUES ('', ?, ?, ?, ?)");
        $query->bind_param('ssss',
            $this->escape_string($registerData->getNickname()),
            $this->escape_string($registerData->getPassword()),
            $this->escape_string($registerData->getRealName()),
            $this->escape_string($registerData->getUserID()));
        $query->execute();
    }

    /**
     * This method returns nickname that matches userID in database
     * @param $userID
     * @return mixed;
     */
    public function getNicknameByIDFromDB($userID){
        $query = $this->connect->prepare("SELECT `".self::NICKNAME_COL."` FROM `".self::TABLE_NAME."` WHERE `".self::USER_ID_COL."` = ?");
        $query->bind_param('s', $userID);
        $query->execute();
        $query->bind_result($nickname);
        $query->fetch();

        return $nickname;
    }

    private function escape_string($param){
        return $this->connect->real_escape_string($param);
    }
}
?>