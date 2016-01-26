<?php
namespace Model;

class User{
    private $nickname;
    private $real_name;
    private $password;
    private $userID;

    /**
     * User constructor - creates new user with following data
     * @param $nickname
     * @param $real_name
     * @param $password
     * @param $userID
     */
    public function __construct($nickname, $real_name, $password, $userID){
        $this->nickname = $nickname;
        $this->real_name = $real_name;
        $this->password = $password;
        $this->userID = $userID;
    }

    /**
     * A getter for users nickname
     * @return mixed
     */
    public function getNickname(){
        return $this->nickname;
    }

    /**
     * A getter for users real name
     * @return mixed
     */
    public function getRealName(){
        return $this->real_name;
    }

    /**
     * A getter for users password
     * @return mixed
     */
    public function getPassword(){
        return $this->password;
    }

    /**
     * A getter for users id
     * @return mixed
     */
    public function getUserID(){
        return $this->userID;
    }

}
?>