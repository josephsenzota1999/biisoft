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
        $mysqli->query("DELETE FROM `bot` WHERE `bot`.`bot_id` = $id") or die("error");
        echo "<script> alert('BOT Deleted!'); window.location.assign('../bot.php');</script>";

    }

}

?>