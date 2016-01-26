<?php
namespace View;

use \Controller\SessionManager;
use \Util\Util;
use \Exceptions\CustomException;

require_once 'classes/Util/Util.php';
Util::initRequest();

$controller = "";
$messageToUser = "";

if(isset($_POST['reg_username'])&&
    isset($_POST['reg_real_name']) &&
    isset($_POST['reg_password']) &&
    isset($_POST['reg_password_again'])){

    if(!empty($_POST['reg_username']) &&
        !empty($_POST['reg_real_name']) &&
        !empty($_POST['reg_password']) &&
        !empty($_POST['reg_password_again'])) {

        $username = htmlentities($_POST['reg_username'], ENT_QUOTES);
        $real_name = htmlentities($_POST['reg_real_name'], ENT_QUOTES);
        $password = $_POST['reg_password'];
        $password_again = $_POST['reg_password_again'];

        try{
            $controller = SessionManager::getController();
            $controller->registerNewUser($username, $real_name, $password, $password_again);
            $messageToUser = "<p class = 'positiveMessageBox'>You have been registered! Log in to use your account!</p>";
        }catch(CustomException $ex){
            $messageToUser = "<p class = 'warningMessageBox'>".$ex->getMessage()."</p>";
        }catch(\mysqli_sql_exception $ex){
            $messageToUser = "<p class = 'negativeMessageBox'>An error in connection with database occurred! Please contact administration of this website.</p>";
        }finally{
            SessionManager::storeController($controller);
        }

    }else{
        $messageToUser = "<p class = 'warningMessageBox'>All fields have to be filled!</p>";
    }
}


$_GET['page'] = $_SESSION['pageId'];
include Util::VIEWS_PATH."redirect.php";
?>