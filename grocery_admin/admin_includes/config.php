<?php
error_reporting(0);
ob_start();
date_default_timezone_set("Asia/Kolkata");
if(!isset($_SESSION)) 
{    
  session_start();
   if(isset($_SESSION['timestamp'])){
       if(time() - $_SESSION['timestamp'] > 60000000) { //subtract new timestamp from the old one
            header("Location: logout.php"); //redirect to logout.php
            exit;
        } else {
            $_SESSION['timestamp'] = time(); //set new timestamp
        }
    }    
}  

$setcon = 1;
if($setcon == 2) {
    $servername = "localhost";
    $username = "myservant";
    $password = "lancius12#";
    $dbname = "myservant";
} else {
    $servername = "localhost";  
    $username = "myservant";
    $password = "lancius12#";
    $dbname = "myservant_grocery";
}  

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//$base_url = "http://palle2patnam.com/lancius/myservant/";
 $base_url = "http://palle2patnam.com/lancius/myservant/";
 
?>