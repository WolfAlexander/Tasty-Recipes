<?php
namespace DTO;

class RegisterData{
    private $nickname;
    private $real_name;
    private $password;
    private $password_again;

    /**
     * RegisterData constructor.
     * @param $nickname
     * @param $real_name
     * @param $password
     * @param $password_again
     */
    public function __construct($nickname, $real_name, $password, $password_again){
        $this->nickname = $nickname;
        $this->real_name = $real_name;
        $this->password = $password;
        $this->password_again = $password_again;
    }

    /**
     * @return mixed
     */
    public function getNickname(){
        return $this->nickname;
    }

    /**
     * @return mixed
     */
    public function getRealName(){
        return $this->real_name;
    }

    /**
     * @return mixed
     */
    public function getPassword(){
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getPasswordAgain(){
        return $this->password_again;
    }
}
?>