<?php 
    session_start();
    require_once('constants.php');
    require_once('db_connection.php'); 
    require_once('functions.php');
    $nthOfType = isset($_GET['menu'])? $_GET['menu']: header('location:index.php?menu=1');
    $userAccess = $_SESSION['admin'] === true ? "admin" : ($_SESSION['user'] === true ? "user" : false);
    if($_GET['menu'] == 5 && isset($_SESSION) && $userAccess !== "admin"){ header('location:index.php?menu=1'); }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <script src="js/modernizr.js"></script>        
        <link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <script src="js/jquery.nivo.slider.pack.js" type="text/javascript"></script>
        <script src="js/js.js"></script>
        <title>CVK CHAMPS</title>
    </head>
    <style>
        div>aside>nav>ul li:nth-of-type(<?php echo $nthOfType; ?>)>a{
            color:#000000;    
        }
    </style>
    <body>
        <div class="container">
            <header>
                <h1>CVK CHAMPS</h1>
            </header>
            <aside>
                <nav>
                    <h2>Categories</h2>
                    <ul>
                        <li><a href="index.php?menu=1">Home</a></li>
                        <li><a href="results.php?menu=2">Results</a></li>
                        <li><a href="booking.php?menu=3">Booking</a></li>
                        <li><a href="contact.php?menu=4">Contact</a></li>
                        <?php echo $userAccess === "admin" ? "<li><a href=\"backend.php?menu=5\">backend</a></li>" : "" ?>
                    </ul>
                    <img src="img/bottom.png" /> 
                </nav>
                <div id="loginSignUp">
                	<div class="login">
                        <div class="login_headline"><h3>Login</h3></div><img src="img/headline.png" />
						<?php 
                            if($userAccess === "admin" || $userAccess == "user"){
                            	$name = getUsersName($rcUsers,$_SESSION['id'],$dbCon);
								echo "<p>{$name}</p>";
                            }else{
                        ?>
                        <form action="actions.php" method="POST"> 
                            <label for="nameLogin">Username:</label>
                            <input id="nameLogin" type="text" name="nameLogin" />
                            <label for="PasswordForm">Password:</label>
                            <input id="PasswordForm" type="password" name="passwordHashed" />
                            <input class="login_button" type="submit" name="login" value="Login" />
                        </form>               
						<?php 
                            }
                        ?>
                        <a href=<?php echo $userAccess != false ? "actions.php?logout=true>logout" : "javascript:void(0);>signup" ?></a>
                    </div>
                    <div class="signUp">
                        <div class="signUp">
                        <form action="actions.php" method="post">
                            <labe>Full Name</label>
                            <input type="text" name="signUpName">
                            <label>Username</label>
                            <input type="text" name="signUpUserName">
                            <label>Password</label>
                            <input type="password" name="signUpPassword">
                            <label>Male</lable>
                            <input type="radio" name="signUpGender" value="male">
                            <lable>Female</lable>
                            <input type="radio" name="signUpGender" value="female">
                            <select name="birthDay">
                                <option>Day</option>
                                <?php dropDownDate("signUpDay"); ?>
                            </select>
                            <select name="birthMonth">
                                <option>Month</option>
                                <?php dropDownDate("signUpMonth"); ?>
                            </select>
                            <select name="birthYear">
                                <option>Year</option>
                                <?php dropDownDate("signUpYear"); ?>
                            </select>
                            <label>Address</label>
                            <input type="text" name="signUpAddress">
                            <label>E-mail</label>
                            <input type="text" name="signUpEmail">
                            <label>Phone</label>
                            <input type="text" name="signUpPhone">
                            <input type="submit" name="signUpSubmit" value="Done">
                        </form>
                    </div>
                    </div>
                </div>
            </aside>