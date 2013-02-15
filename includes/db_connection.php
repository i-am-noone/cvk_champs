<?php
    $dbCon = new MYSQLi(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
    if($dbCon->connect_errno){
        die("Connection faild" . $dbCon->connect_erno . " : " . $dbCon->connect_error);
    }
    $dbCon->set_charset('utf8');
    $rcRuns = "rcRuns";
    $rcChamp = "rcChamp";
    $rcRoutes = "rcRoutes";
    $rcUsers = "rcUsers";
?>