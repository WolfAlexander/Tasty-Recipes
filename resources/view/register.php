<?php
$_SESSION['pageId'] = $_GET['page'];
use Util\Util;
?>

<section id="register">
    <?php echo $messageToUser;?>
    <h2>Register</h2>
    <article>
        You can register on our website to be able to comment recipes!
        Just fill the form down below and click register button!
    </article>

    <?php
    if(!isset($_SESSION[Util::USER_SESSION_NAME]) && empty($_SESSION[Util::USER_SESSION_NAME])){
        echo "<form action = 'register-user.php' method = 'POST'>
                Nickname:<input type = 'text' name = 'reg_username' placeholder='Enter your nickname here...'/>
                Real name:<input type = 'text' name = 'reg_real_name' placeholder='Enter your real name here...''/>
                Password: <input type = 'password' name = 'reg_password' placeholder='Enter your password here...'/>
                Password again: <input type = 'password' name = 'reg_password_again' placeholder='Enter your password again here...'/>
                <input type = 'submit' value = 'Register'/>
            </form>";
    }else{
        echo "<p class = 'positiveMessageBox'>Your are logged in. :) You cannot register again.</p>";
    }
    ?>
</section>