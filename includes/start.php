<?php
ini_set("display_errors","On");
// date_default_timezone_set()
date_default_timezone_set('Africa/Nairobi');
// GET THE ROOT URL
define ('MAIN_URL','http://localhost/POS');
// echo MAIN_URL;
    
//  TO CONNECT WITH DATABASE;
   $mysqli = new mysqli('localhost','root','','biisoft');
            if (!$mysqli) {
                # code...
                echo "no connecton!";
            }else {
                
                // echo "connection is established";
            }
        
// TRACKING USERS ACTIVITIES

    $ip = $_SERVER['REMOTE_ADDR'];
    // // echo "<br>";
    $page = $_SERVER['PHP_SELF'];
    $time = time();
    // check if $_SESSION['USERNAME'] is set 
    if (isset($_SESSION['USERNAME'])) {
        # code...
         $by = $_SESSION['USERNAME'];
    }else{
        $by = 'Unkwon';
    }
    
     $mysqli->query("INSERT INTO tracker(page,ip,time,user) VALUES('$page','$ip','$time','$by')") or die(mysqli_error($mysqli));


?>