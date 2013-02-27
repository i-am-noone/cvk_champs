<?php
    session_start();
    //session_destroy();
    include('includes/constants.php');
    require_once('includes/db_connection.php');
    require('includes/functions.php');
    if(isset($_POST['nameLogin'])){
        $username = $_POST['nameLogin'];
        $passwordHashed = sha1($_POST['passwordHashed']);
        if($username == ADMIN_USER && $passwordHashed == ADMIN_PASSWORD){
            $_SESSION['admin'] = true;
    		$_SESSION['admin']['id'] = "admin";
            $header = "backend.php?menu=5";
        }else{
            echo $query = "
                SELECT
                    hashedPassword,id
                FROM
                    $rcUsers
                WHERE
                    userName = '$username'
            ";
            $password = $dbCon->query($query)->fetch_object()->hashedPassword;
			$id = $dbCon->query($query)->fetch_object()->id;
            if($passwordHashed == $password){
                $_SESSION['user'] = true;
				$_SESSION['id'] = $id;
            }
            $header = end(explode("/",$_SERVER['HTTP_REFERER']));
        }
    }elseif(isset($_GET['logout'])){
		session_destroy();
		$header = end(explode("/",$_SERVER['HTTP_REFERER']));
	}elseif(isset($_POST['signUpSubmit'])){
        $day = trim($_POST['birthDay']);
        $month = trim($_POST['birthMonth']);
        $year = trim($_POST['birthYear']);
        $insert['name'] = trim($_POST['signUpName']);
        $insert['userName'] = trim($_POST['signUpUserName']);
        $insert['hashedPassword'] = sha1(trim($_POST['signUpPassword']));
        $insert['address'] = trim($_POST['signUpAddress']);
        $insert['gender'] = trim($_POST['signUpGender']);
        $insert['birthDate'] = strtotime("{$day}-{$month}-{$year}");
        $insert['email'] = trim($_POST['signUpEmail']);
        $insert['phone'] = trim($_POST['signUpPhone']);
        $table = "rcUsers";
        insert($table,$insert,$dbCon);
        $header = end(explode("/",$_SERVER['HTTP_REFERER']));
    }elseif(isset($_POST['routeSubmit'])){
        $insert['name'] = $dbCon->real_escape_string($_POST['routeName']);
        $insert['distance'] = $dbCon->real_escape_string($_POST['routeDistance']);
        $insert['googleMap'] = $dbCon->real_escape_string($_POST['routeGoogleMap']);
        $insert['description'] = $dbCon->real_escape_string($_POST['routeDescription']);
        $table = "rcRoutes";
        insert($table,$insert,$dbCon);
        $header = "backend.php?menu=5";
    }elseif(isset($_POST['runDescription'])){
        $day = trim($_POST['addRunDay']);
        $month = trim($_POST['addRunMonth']);
        $year = trim($_POST['addRunYear']);
        $insert['name'] = $dbCon->real_escape_string($_POST['runName']);
        $insert['routeID'] = $dbCon->real_escape_string($_POST['routeID']);
        $insert['startDate'] = strtotime("{$day}-{$month}-{$year}");
        $insert['price'] = $dbCon->real_escape_string($_POST['runPrice']);
        $insert['description'] = $dbCon->real_escape_string($_POST['runDescription']);
        $table = "rcRuns";
        insert($table,$insert,$dbCon);
        $header = "backend.php?menu=5";
    }elseif(isset($_POST['submitBook'])){
        $insert['userID'] = $dbCon->real_escape_string($_POST['bookUserID']);
        $insert['runID'] = $dbCon->real_escape_string($_POST['bookRunID']);
        $table = "rcChamps";
        insert($table,$insert,$dbCon);
        $header = end(explode("/",$_SERVER['HTTP_REFERER']));
    }
    header("location:{$header}");
?>