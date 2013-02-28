<?php include('includes/header.php'); ?>
    <section>
        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
                <img src="img/img1.jpg" alt="" title="img1" />
                <img src="img/img2.jpg" alt="" title="img2" />
                <img src="img/img1.jpg" alt="" title="img3" />
                <img src="img/img2.jpg" alt="" title="img4" />
            </div>
        </div>   
        <div class="competition">
            <div class="competition_box">
                <div class="competition_headline"><h3>Upcoming events</h3></div><img src="img/headline2.png" />
                <?php 
                    $run = getLatestEvent($rcRuns,$rcRoutes,$dbCon);
                    foreach($run as $key=>$value){
                        echo "<p id=\"$key\">{$value}</p>";
                    }
                ?>
                <a href="runs.php?menu=3&moreInfo=<?php echo $run['ruID']; ?>">Read More About The Run</a>
            </div>
            <?php echo $userAccess === 'user' ? loginBooking($run['ruID'],$_SESSION['id'],$dbCon) : "<a class=\"loginToBook\" href=\"javascript:void(0);\">login to book</a>"; ?>           
            <div class="competition_box">
                <div class="competition_headline"><h3>Top 3</h3></div><img src="img/headline2.png" /> 
                <?php 
                    $set = getTop3($rcUsers,$rcChamps,$rcRuns,$dbCon);                    
                ?>
                    <table>
                    <?php
                        while($top3 = $set->fetch_object()){
                    ?>
                            <tr>
                                <td><?php echo $top3->name; ?></td>
                                <td><?php echo gmdate('h:i:s',$top3->record); ?></td>
                            </tr>
                    <?php
                        }
                    ?>
                    </table>
                </div>        
        </div>
    </section>
    <script type="text/javascript">
        $(window).load(function() {
            $('#slider').nivoSlider();
        });
    </script>
<?php include('includes/footer.php'); ?>