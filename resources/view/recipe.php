<?php
use Controller\SessionManager;
use Util\Util;

$_SESSION['pageId'] = $_GET['page'];

include_once 'resources/xml/tastyRecipesCookbook.php';
$cookbook = new SimpleXMLElement($xmlstr);

if($_GET['page'] == 'swemeatballs')
    $thisRecipe = $cookbook->recipe[0];
else
    $thisRecipe = $cookbook->recipe[1];

$controller = SessionManager::getController();
?>


<section class = "recipe">
    <?php echo $messageToUser;?>
    <h2><?php echo $thisRecipe->title; ?></h2>
    <div class = "recipeInfo">
        <img class = "recipeImg" src = "<?php echo $thisRecipe->imagepath;?>" alt = "<?php echo $thisRecipe->title;?> image"/>
        <ul class = "recipeTimeInfo">
            <li><?php echo $thisRecipe->preptime; ?></li>
            <li><?php echo $thisRecipe->cooktime; ?></li>
        </ul>
    </div>

    <!--Ingredients Box-->
    <input type = "checkbox" id = "ingredients"/>
    <div class = "expandableBox">
        <label for = "ingredients" class = "expandableBoxHeader">
            <span>Ingredients</span>
            <img src = <?php echo Util::IMG_PATH."clickHand.png"?> alt = "Click to close or open"/>
        </label>

        <article class = "expandableBoxContent">
            <ul>
                <?php foreach($thisRecipe->ingredient->li as $ingredient){echo '<li>'.$ingredient.'</li>';} ?>
            </ul>
        </article>
    </div>

    <!--Directions Box-->
    <input type = "checkbox" id = "directions"/>
    <div class = "expandableBox">
        <label for = "directions" class = "expandableBoxHeader">
            <span>Directions</span>
            <img src = <?php echo Util::IMG_PATH."clickHand.png"?> alt = "Click to close or open"/>
        </label>

        <article class = "expandableBoxContent">
            <ol>
                <?php foreach($thisRecipe->recipetext->li as $recipetext){echo '<li>'.$recipetext.'</li>';} ?>
            </ol>
        </article>
    </div>

    <!--Natritional facts Box-->
    <input type = "checkbox" id = "natritionalFacts"/>
    <div class = "expandableBox">
        <label for = "natritionalFacts" class = "expandableBoxHeader">
            <span>Nutritional Facts</span>
            <img src = <?php echo Util::IMG_PATH."clickHand.png"?> alt = "Click to close or open"/>
        </label>

        <article class = "expandableBoxContent">
            <?php echo $thisRecipe->nutrition; ?>
        </article>
    </div>

    <!--Leave comments section-->
    <input type = "checkbox" id = "leaveComment"/>
    <div class = "expandableBox">
        <label for = "leaveComment" class = "expandableBoxHeader">
            <span>Leave a comment</span>
            <img src = <?php echo Util::IMG_PATH."clickHand.png"?> alt = "Click to close or open"/>
        </label>

        <div class = "expandableBoxContent" id = "leaveCommentForm">
            <span data-bind="html: postMessageToUser"></span>
            <?php
            if(isset($_SESSION[Util::USER_SESSION_NAME]) && !empty($_SESSION[Util::USER_SESSION_NAME])){
                echo '<div>
                        <p>Name: <span class = "leaveCommentUsername">'.$controller->getNicknameByID($_SESSION[Util::USER_SESSION_NAME]).'</span></p>
                        <p>Comment: <br/> <textarea data-bind = "textInput: commentMsgToPost" placeholder="Wright your comment here..."></textarea></p>
                        <input type = "button" data-bind="click: $root.postComment" value = "Leave a comment" />
                      </div>';
            }else{
                echo '<p class = "informationBox">You have to be logged in to be able to write comments. You can log in by using login form at top menu.
                        If your are not registered on website - fill free to <a href = "index.php?page=register">register</a> and log in to write comments!</p>';
            }
            ?>
        </div>
    </div>

    <!--Comments-->
    <input type = "checkbox" id = "comments"/>
    <div class = "expandableBox">
        <label for = "comments" class = "expandableBoxHeader">
            <span>Comments</span>
            <img src = <?php echo Util::IMG_PATH."clickHand.png"?> alt = "Click to close or open"/>
        </label>

        <span id = "editMessageToUser" data-bind="html: editMessageToUser"></span>

        <article class = "expandableBoxContent" id = "commentsWindow" data-bind = "foreach:comments">
            <div class = "comment">
                <div class = "commentHeader">
                    <span class = "commentUsername" data-bind="text: nickname"></span>
                    <span class = "commentDate" data-bind="text: date"></span>
                    <!-- ko if: editable -->
                    <input type = "button" data-bind="click: $root.showFormForEditingComment.bind(this), visible: !editingComment()" value="Edit comment"/>
                    <!-- /ko -->
                </div>
                <div class = "commentText" data-bind="text: commentMsg, visible: !editingComment()"></div>
                <div data-bind="visible: editingComment()">
                    <textarea data-bind="textInput: editedCommentMsg"></textarea>
                    <input type = "button" data-bind="click: $root.postEditedComment.bind(this)" value = "Post edited comment"/>
                    <input type = "button" data-bind="click: $root.cancelEditing.bind(this)" value="Cancel"/>
                </div>
            </div>
        </article>
    </div>
</section>

<script type = "text/javascript" src = "resources/js/commentsViewModel.js"></script>