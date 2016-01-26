<?php
namespace Model;

use DTO\LoginData;
use DTO\RegisterData;
use Exceptions\CustomException;
use Integration\UserDAO;

class UserHandler{
    /**
     * This method performs registration checks of the user data before sending data to DB handler for registration
     * @param RegisterData $userRegData - DTO that contain data entered by user in registration form
     * @throws CustomException if an error occurred during registration
     */
    public function register(RegisterData $userRegData){
        $userDAO = new UserDAO();

        if($this->registrationChecks($userDAO, $userRegData))
            $userDAO->registerNewUserInDB(new User($userRegData->getNickname(),
                $userRegData->getRealName(),
                password_hash($userRegData->getPassword(), PASSWORD_BCRYPT),
                $this->generateUserId($userRegData->getNickname(), $userRegData->getRealName(), md5($userRegData->getPasswordAgain()))));
        else
            throw new CustomException("Unfortunately an registration error occurred! :( Try again! If it happends again, please contact administration of this website.");
    }

    /**
     * This method performs login functionality
     * @param LoginData $userLoginData
     * @throws CustomException if nickname not found or password does not match or other login error occurred
     */
    public function login(LoginData $userLoginData){
        $userDAO = new UserDAO();

        if($userDAO->doNicknameExistInDB($userLoginData->getNickname())){
            if(password_verify($userLoginData->getPassword(), $userDAO->getUserPasswordFromDB($userLoginData->getNickname()))){
                session_regenerate_id();
                $_SESSION['tastyRecipeUser'] = $userDAO->getUserIdFromDB($userLoginData);
            }else
                throw new CustomException("Password do not match with username you entered! :( Try again!");
        }else{
            throw new CustomException("We could not find the nickname you entered. :( Make sure you enter right nickname! ");
        }
    }

    /**
     * This method performs logout operations
     */
    public function logout(){
        session_regenerate_id();
        session_unset();
        session_destroy();
    }

    private function registrationChecks(UserDAO $userDAO, RegisterData $userRegData){
        $password = password_hash($userRegData->getPassword(), PASSWORD_BCRYPT);

        if(password_verify($userRegData->getPasswordAgain(), $password)){
            if(!$userDAO->doNicknameExistInDB($userRegData->getNickname()))
                return true;
            else
                throw new CustomException("Unfortunately username you entered is already taken. :( Try another one!");
        }else{
            throw new CustomException("Passwords you entered do not match. :( Try again!");
        }
    }

    private function generateUserId($nickname, $real_name, $password_again){
        return bin2hex(openssl_random_pseudo_bytes(3, $cstrong)).md5($nickname.$password_again.$real_name).bin2hex(openssl_random_pseudo_bytes(6, $cstrong));
    }
}
?>