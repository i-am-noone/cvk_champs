<?php include('includes/header.php'); ?>
    <section>
    	<?php    		
    		if(isset($_GET['moreInfo'])){
    			$runID = $_GET['moreInfo'];
    			$set = getRunInformation($rcChamps,$rcUsers,$rcRuns,$rcRoutes,$runID,$dbCon);
    		}else{
    			$set = getRuns($rcRuns,$rcRoutes,$dbCon);
    		}
   			while($run = $set->fetch_object()){
    	?>
	    		<div>
					<p><?php echo $run->roGM; ?></p>
					<p><?php echo $run->ruN; ?></p>
					<p>Price: <?php echo $run->ruP; ?> kr.</p>
					<p>Description: <?php echo $run->ruD; ?></p>
					<p>Starting Date: <?php echo date('d-m-Y',$run->ruST); ?></p>
					<p>Route Name: <?php echo $run->roN; ?></p>
					<p>Route Description: <?php echo $run->roDe; ?></p>
					<p>Route Distance: <?php echo $run->roDi; ?> Km.</p>
					<p>Best Record: <?php echo $run->roBT; ?></p>
                    <?php if(isset($_GET['moreInfo'])){ ?>
                    <p><?php date('y',$run->uMinBD-time()) . "-". date('y',$run->uMaxBD-time()); ?></p>
                    <p>Female participations: <?php echo $run->uFemale; ?></p>
                    <p>Male participations: <?php echo $run->uMale; ?></p>
                    <p>Total Participations: <?php echo $run->uGCount; ?></p>
                    <?php } ?>
	    		</div>
	    		<a href="?menu=3&moreInfo=<?php echo $run->ruID; ?>">Read More About The Run</a>
    	<?php	
    		echo $userAccess === 'user' ? loginBooking($run->ruID,$_SESSION['id'],$dbCon) : "<a class=\"loginToBook\" href=\"javascript:void(0);\">login to book</a>";
    		}
            if($userAccess === 'admin'){
                echo "<table>";
                $parsitipations = getParticipations($rcChamps,$rcUsers,$runID,$dbCon);
                while ($par = $parsitipations->fetch_object()){
        ?>
                    <tr>
                        <td><?php echo $par->uUN; ?></td>
                        <td>
                            <form action="actions.php" method="post">
                                <input type="hidden" name="userID" value="<?php echo $par->uID; ?>">
                                <input type="hidden" name="runID" value="<?php echo $par->ruID; ?>">
                                <input type="text" name="userRecord">
                                <input type="submit" name="submitRecord" value="register">
                            </form>
                        </td>
                    </tr>
        <?php
                }
                echo "</table>";
            }
        ?>
    </section>
<?php include('includes/footer.php'); ?>