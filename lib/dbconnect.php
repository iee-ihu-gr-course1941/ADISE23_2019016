<?php

$host='localhost';
$db = 'griniaris';
require_once "db_upass.php";

$user=$DB_USER;
$pass=$DB_PASS;


if(gethostname()=='users.iee.ihu.gr') {
    try{
	$mysqli = new mysqli($host, 'iee2019016', '', $db,null,'/home/staff/iee2019016/mysql/run/mysql.sock'); }
    catch(Exception $e){
        echo 'Not connected ' .$e->getMessage();
    }
} else {
    try{
        $mysqli = new mysqli($host, $user, $pass, $db);
        //echo 'connected';
    }
        catch(Exception $e){
            echo 'Not connected ' .$e->getMessage();
        }
        
}

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . 
    $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

?>