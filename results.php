<?php include('includes/header.php'); ?>
    <section>
      <?php              		

        $set = getRunResults($rcRuns,$rcRoutes,$dbCon);
   			while($run = $set->fetch_object()){
    	?>
	    		<div>
					<p><?php echo $run->roGM; ?></p>
					<p><?php echo $run->ruN; ?></p>
					<p>Starting Date: <?php echo date('d-m-Y',$run->ruST); ?></p>
					<p>Route Name: <?php echo $run->roN; ?></p>
					<p>Route Distance: <?php echo $run->roDi; ?> Km.</p>
	    		</div>
	    		<a href="?menu=3&moreInfo=<?php echo $run->ruID; ?>">Read More About The Run</a>
        <?php
                   echo "<table>";
                   $parsitipations = getParticipations($rcChamps,$rcUsers,$run->ruID," <> ",$dbCon);
                   while ($par = $parsitipations->fetch_object()){
        ?>
                    <tr>
                        <td><?php echo $par->uUN; ?></td>
                        <td><?php echo $par->cR; ?></td>
                    </tr>
        <?php
                   }
                   echo "</table>";
            }
        ?>
    </section>
<?php include('includes/footer.php'); ?>