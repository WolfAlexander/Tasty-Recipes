<?php
namespace DTO;

class LoginData{
    private $nickname;
    private $password;

    /**
     * Constructor of a DT0 - assigns data
     * @param $nickname
     * @param $password
     */
    public function __construct($nickname, $password){
        $this->nickname = $nickname;
        $this->password = $password;
    }

    /**
     * Returns nickname entered in login form
     * @return mixed - nickname
     */
    public function getNickname(){
        return $this->nickname;
    }

    /**
     * Returns password entered in login form
     * @return mixed - password
     */
    public function getPassword(){
        return $this->password;
    }
}
?>