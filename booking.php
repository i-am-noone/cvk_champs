<?php include('includes/header.php'); ?>
    <section>
    	<?php    		
    		if(isset($_POST['moreInfo'])){
    			$runID = $_POST['moreInfo'];
    			$andWhere = " AND ru.id = '$runID'";
    			$set = getRunInformation($rcChamps,$rcUsers,$rcRuns,$rcRoutes,$andWhere,$dbCon);
    		}else{
    			$set = getRuns($rcRuns,$rcRoutes,$dbCon);
    		}
   			while($run = $set->fetch_object()){
    	?>
	    		<div>
					<p><?php echo $run->roGM; ?></p>
					<p><?php echo $run->ruN; ?></p>
					<p><?php echo $run->ruP; ?></p>
					<p>Description: <?php echo $run->ruD; ?></p>
					<p>Starting Date: <?php echo date('d-m-Y',$set->ruST); ?></p>
					<p>Route Name: <?php echo $run->roN; ?></p>
					<p>Route Description: <?php echo $run->roDe; ?></p>
					<p>Route Distance: <?php echo $run->roDi; ?> Km.</p>
					<p>Best Record: <?php echo $run->roBT; ?></p>
	    		</div>
	    		<a href="?menu=3&moreInfo=<?php echo $run->ruID; ?>">Read More The Run</a>
    	<?php	
    		echo $userAccess === 'user' ? loginBooking($run->ruID,$_SESSION['id'],$dbCon) : "<a class=\"loginToBook\" href=\"javascript:void(0);\">login to book</a>";
    		}
    	?>
    </section>
<?php include('includes/footer.php'); ?>