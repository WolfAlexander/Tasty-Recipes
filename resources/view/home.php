<?php $_SESSION['pageId'] = $_GET['page']; ?>

<section>
    <?php echo $messageToUser;?>
    <h2>Welcome to Tasty Recipes!</h2>
    <article>
        Here you can find meals for every day of the week!
        Check our calendar to see which day you should prepare special meals!
        And of course check our recipes!
    </article>

    <div id = "calendarLogo">
        <a href = "index.php?page=calendar"><img src = <?php echo Util\Util::IMG_PATH."calendar.png";?> alt = "calendar"/></a>
    </div>
</section>