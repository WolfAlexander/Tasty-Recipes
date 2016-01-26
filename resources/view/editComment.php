<?php
use Util\Util;
?>

<section>
    <h2>Edit your comment</h2>
    <?php echo $messageToUser; ?>
    <?php
    if(isset($_SESSION[Util::USER_SESSION_NAME]) && isset($_POST['commentTime']) && isset($_POST['pageID'])){
        echo "<form action = 'do-edit-comment.php' method='POST'>
                    <input type = 'hidden' name = 'commentTime' value = '".$_POST['commentTime']."'/>
                    <input type = 'hidden' name = 'pageID' value = '".$_POST['pageID']."'/>
                    <textarea name = 'editedComment'>".$oldMessage."</textarea>
                    <input type = 'submit' value = 'Edit your comment'/>
                </form>";
    }else{
        echo "<p class = 'negativeMessageBox'>You are trying to edit comment you did not write or something else you should not do!</p>";
    }
    ?>
</section>
