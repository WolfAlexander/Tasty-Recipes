<?php $_SESSION['pageId'] = $_GET['page']; ?>

<section>
    <?php echo $messageToUser;?>
    <h2>Calendar</h2>
    <article>
        Thought following calendar you can see our suggestions of food for different days.
        Click on image of a meal to see it's recipe.
    </article>
    <br/>
</section>

<section class = "calendar">
    <!--First Week-->
    <div class = "week">
        <p class = "weekIndication">Week 1</p>
        <div class = "day"><p>Monday 1</p></div>
        <div class = "day"><p>Tuesday 2</p></div>
        <div class = "day"><p>Wednesday 3</p></div>
        <div class = "day"><p>Thursday 4</p>
            <a href = "index.php?page=swemeatballs"><img src = <?php echo Util\Util::IMG_PATH."sweMeatballs_small.jpg";?> alt = "Meatball day"/></a>
        </div>
        <div class = "day"><p>Friday 5</p></div>
        <div class = "day weekend"><p>Saturday 6</p></div>
        <div class = "day weekend"><p>Sunday 7</p></div>
    </div>

    <!--Second Week-->
    <div class = "week">
        <p class = "weekIndication">Week 2</p>
        <div class = "day"><p>Monday 8</p>
            <a href = "index.php?page=maplepancakes"><img src = <?php echo Util\Util::IMG_PATH."maplePancakes_small.jpg";?> alt = "Pancakes day"/></a>
        </div>
        <div class = "day"><p>Tuesday 9</p></div>
        <div class = "day"><p>Wednesday 10</p></div>
        <div class = "day"><p>Thursday 11</p></div>
        <div class = "day"><p>Friday 12</p></div>
        <div class = "day weekend"><p>Saturday 13</p></div>
        <div class = "day weekend"><p>Sunday 14</p></div>
    </div>

    <!--Third Week-->
    <div class = "week">
        <p class = "weekIndication">Week 3</p>
        <div class = "day"><p>Monday 15</p></div>
        <div class = "day"><p>Tuesday 16</p></div>
        <div class = "day"><p>Wednesday 17</p></div>
        <div class = "day"><p>Thursday 18</p></div>
        <div class = "day"><p>Friday 19</p></div>
        <div class = "day weekend"><p>Saturday 20</p>
            <a href = "index.php?page=swemeatballs"><img src = <?php echo Util\Util::IMG_PATH."sweMeatballs_small.jpg";?> alt = "Meatball day!"/></a>
        </div>
        <div class = "day weekend"><p>Sunday 21</p></div>
    </div>

    <!--Fourth Week-->
    <div class = "week">
        <p class = "weekIndication">Week 4</p>
        <div class = "day"><p>Monday 22</p></div>
        <div class = "day"><p>Tuesday 23</p></div>
        <div class = "day"><p>Wednesday 24</p></div>
        <div class = "day"><p>Thursday 25</p></div>
        <div class = "day"><p>Friday 26</p></div>
        <div class = "day weekend"><p>Saturday 27</p></div>
        <div class = "day weekend"><p>Sunday 28</p></div>
    </div>

    <!--Fifth Week-->
    <div class = "week">
        <p class = "weekIndication">Week 5</p>
        <div class = "day"><p>Monday 29</p></div>
        <div class = "day"><p>Tuesday 30</p></div>
        <div class = "day"><p>Wednesday 31</p></div>
        <div class = "day notCalendarDay"></div>
        <div class = "day notCalendarDay"></div>
        <div class = "day weekend notCalendarDay"></div>
        <div class = "day weekend notCalendarDay"></div>
    </div>
</section>