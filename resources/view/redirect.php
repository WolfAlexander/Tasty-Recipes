<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Tasty Recipes - ID1354</title>
    <link rel="stylesheet" type="text/css" href="resources/css/main_style.css"/>
    <link rel="stylesheet" type="text/css" href="resources/css/topNav_style.css"/>
    <link rel="stylesheet" type="text/css" href="resources/css/media_screen.css"/>
    <link rel = "stylesheet" type="text/css" href = "resources/css/home_style.css"/>
    <link rel = "stylesheet" type="text/css" href = "resources/css/recipes_style.css"/>
    <link rel = "stylesheet" type="text/css" href = "resources/css/calendar_style.css"/>
    <script type = "text/javascript" src = "resources/js/jquery.js"></script>
    <script type = "text/javascript" src = "resources/js/knockout.js"></script>
</head>
<body>
<nav id = "topNav">
    <div id = "logo"><a href = "index.php?page=home">Tasty Recipes</a></div>

    <input type = "checkbox" id = "menuItemsCheckbox"/>
    <!--Left menu-->
    <ul class = "menuItems">
        <li <?php if(@$_GET['page'] == 'calendar') echo 'class="current"'?>><a href = "index.php?page=calendar">Calendar</a></li>
        <li <?php if(@$_GET['page'] == 'swemeatballs') echo 'class="current"'?>><a href = "index.php?page=swemeatballs">Swedish Meatballs</a></li>
        <li <?php if(@$_GET['page'] == 'maplepancakes') echo 'class="current"'?>><a href = "index.php?page=maplepancakes">Maple Pancakes</a></li>
    </ul>

    <!--Right menu-->
    <ul class = "menuItems" id = "rightMenu">
        <?php
        if(isset($_SESSION[\Util\Util::USER_SESSION_NAME]) && !empty($_SESSION[\Util\Util::USER_SESSION_NAME])){
            echo '
                <li><a href = "logout-user.php">Log out</a></li>';
        }else{
            echo '<li><a href = "index.php?page=register">Register</a></li>
                <li class = "dropDown">
                    <input type ="checkbox" id = "loginDropDownCheckbox"/>
                    <form action = "login-user.php" method = "POST">
                        <h3>Login</h3>
                        Nickname: <input type = "text" name = "loginName"/>
                        Password: <input type = "password" name = "loginPassword"/>
                        <input type = "submit" value="Login"/>
                    </form>
                    <label for = "loginDropDownCheckbox" id = "loginDropDownLabel">Login</label>
                </li>';
        }
        ?>

    </ul>

    <label for = "menuItemsCheckbox" id = "menuSmallBttn">Menu</label>
</nav>

<div id = "mainSection">
    <?php
    $mainPage = isset($_GET['page']) ? trim(strtolower($_GET['page'])): "home";
    $mainPages = array(
        'home' => ''.Util\Util::VIEWS_PATH.'home.php',
        'calendar' => ''.Util\Util::VIEWS_PATH.'calendar.php',
        'swemeatballs' => ''.Util\Util::VIEWS_PATH.'recipe.php',
        'maplepancakes' => ''.Util\Util::VIEWS_PATH.'recipe.php',
        'register' => ''.Util\Util::VIEWS_PATH.'register.php',
        'editcomment' => ''.Util\Util::VIEWS_PATH.'editComment.php',
        'logout' => ''.Util\Util::VIEWS_PATH.'logout.php'

    );
    @include_once(isset($mainPages[$mainPage]) ? $mainPages[$mainPage]:$mainPages["home"]);
    ?>
</div>

<footer>
    <ul>
        <li><a href = "index.php?page=calendar">Calendar</a></li>
    </ul>

    <ul>
        <li><a href = "index.php?page=swemeatballs">Swedish Meatballs</a></li>
    </ul>

    <ul>
        <li><a href = "index.php?page=maplepancakes">Maple Pancakes</a></li>
    </ul>
</footer>
</body>
</html>