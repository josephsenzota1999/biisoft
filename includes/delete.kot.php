<?php
include "start.php";

if (isset($_GET['delete'])) {
    # code...
    $id = $_GET['delete'] ?? NULL;
    $timeNow = time();
    // echo $id;
    // check if the $id is number
    if (!is_numeric($id)) {
        # code...
echo "<script> alert('Error!')</script>";

    }else {
        # code...
        $mysqli->query("DELETE FROM `kot` WHERE `kot`.`kot_id` = $id") or die("error");
        echo "<script> alert('KOT Deleted!'); window.location.assign('../kot.php');</script>";

    }

}

?>