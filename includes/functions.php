<?php
    require_once('db_connection.php');
    function insert($table,$insert,$dbCon){
        $query = "
            INSERT INTO
                $table(
        ";
        $firstArray = 1;
        foreach($insert as $column => $value){
            $query .= $firstArray == 1?"":",";
            $query .= "{$column}";
            $firstArray++;
        }
        $query .= "
                )VALUES(
        ";
        $firstArray = 1;
        foreach($insert as $column => $value){
            $query .= $firstArray == 1?"":",";
            $query .= "'{$value}'";
            $firstArray++;
        }
        $query .="
                )
        ";
        echo $query;
        $dbCon->query($query);
    }
	function getUsersName($rcUsers,$id,$dbCon){
		$query = "
			SELECT
				name
			FROM
				$rcUsers
			WHERE
				id = '$id'
		";
		$userName = $dbCon->query($query)->fetch_object()->name;
		return $userName;
	}
    function getRoutes($dbCon){
        global $rcRoutes;
        $query = "
            SELECT id,name,distance
            FROM $rcRoutes
        ";
        $set = $dbCon->query($query);
        while($route = $set->fetch_object()){
            echo "<option value=\"{$route->id}\">{$route->name}/{$route->distance}km</option>";
        }        
    }
    function getRunInformation($rcChamps,$rcUsers,$rcRuns,$rcRoutes,$andWhere,$dbCon){
          echo $query = "
            SELECT 
                ru.id AS ruID,
                ru.name AS ruN,
                ru.price AS ruP,
                ru.description AS ruD,
                ru.startDate AS ruST,
                ro.id AS roID,
                ro.name AS roN,
                ro.googleMap AS roGM,
                ro.description AS roDe,
                ro.distance AS roDi,
                ro.bestTime AS roBT,
                c.id AS cID,
                c.record,
                u.id AS uID,
                u.name AS uN,
                u.gender AS uG,
                u.birthDate AS uBD
            FROM 
                $rcRuns AS ru
            INNER JOIN
                $rcRoutes AS ro
                    ON
                        ru.routeID = ro.id
            INNER JOIN
                $rcChamps AS c 
                    ON
                        c.runID = ru.ID
            INNER JOIN 
                $rcUsers AS u
                    ON
                        u.id = c.userID
            WHERE 
                ru.startDate > UNIX_TIMESTAMP()
                    $andWhere                    
        ";
        $set = $dbCon->query($query);
        return $set;
    }
    function getRuns($rcRuns,$rcRoutes,$dbCon){
        $query = "
            SELECT 
                ru.id AS ruID,
                ru.name AS ruN,
                ru.price AS ruP,
                ru.description AS ruD,
                ru.startDate AS ruST,
                ro.id AS roID,
                ro.name AS roN,
                ro.googleMap AS roGM,
                ro.description AS roDe,
                ro.distance AS roDi,
                ro.bestTime AS roBT
            FROM 
                $rcRuns AS ru
            INNER JOIN
                $rcRoutes AS ro
                    ON
                        ru.routeID = ro.id
            WHERE 
                ru.startDate > UNIX_TIMESTAMP()                       
        ";
        $set = $dbCon->query($query);
        return $set;
    }
    function getLatestEvent($rcRuns,$rcRoutes,$dbCon){
        $query = "
            SELECT 
                ru.id AS ruID,
                ru.name AS ruN,
                ru.price AS ruP,
                ru.description AS ruD,
                ru.startDate AS ruST,
                ro.id AS roID,
                ro.name AS roN,
                ro.googleMap AS roGM,
                ro.description AS roDe,
                ro.distance AS roDi,
                ro.bestTime AS roBT
            FROM 
                $rcRuns AS ru
            INNER JOIN
                $rcRoutes AS ro
                    ON
                        ru.routeID = ro.id
            WHERE 
                ru.startDate > UNIX_TIMESTAMP()
            LIMIT 1                        
        ";
        $set = $dbCon->query($query)->fetch_object();
        $run = array(
            "roGM" => $set->roGM,
            "ruID" => $set->ruID,
            "ruN" => $set->ruN,
            "ruP" => $set->ruP,
            "ruD" => $set->ruD,
            "ruST" => date('d-m-Y',$set->ruST),
            "roID" => $set->roID,
            "roN" => $set->roN,
            "roDe" => $set->roDe,
            "roDi" => $set->roDi,
            "roBT" => $set->roBT
        );
        return $run;
    }
    function dropDownDate($date){
        if($date == "signUpDay" || $date == "addRunDay"){
            $startDate = 1;
            $endDate = 31;
        }elseif($date == "signUpMonth" || $date == "addRunMonth"){
            $startDate = 1;
            $endDate = 12;
        }elseif($date == "signUpYear"){
            $startDate = date('Y')-40;
            $endDate = date('Y')-15;
        }elseif($date == "addRunYear"){
            $startDate = date('Y');
            $endDate = $startDate+2;
        }
        for($i=$startDate; $i<=$endDate; $i++){
            echo "<option value=\"{$i}\">{$i}</option>";
        }
    }
    function loginBooking($runID,$userID,$dbCon){
            $query = "
                SELECT
                    id
                FROM
                    rcChamps
                WHERE
                    runID = '$runID' AND userID = '$userID'
            ";
            $rowCount = $dbCon->query($query)->num_rows;
            if($rowCount === 0){
                echo "<form action=\"actions.php\" method=\"post\">";
                echo "<input type=\"hidden\" name=\"bookRunID\" value=\"{$runID}\">";
                echo "<input type=\"hidden\" name=\"bookUserID\" value=\"{$userID}\">";
                echo "<input type=\"submit\" name=\"submitBook\" value=\"Book\">";
                echo "</form>";
                "<a href=\"javascript:void(0);\">login to book</a>";
            }else{
                echo "<p>you are booked for this run</p>";
            }
    }
?>











