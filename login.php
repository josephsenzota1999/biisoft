<?php 
session_start();
include "includes/start.php";
// other code goes here
if (isset($_POST['login'])) {
    # code...
    // echo "good pass"; 
   
    $username = $mysqli->escape_string($_POST['username']);
    $pwd = $mysqli->escape_string($_POST['pwd']);
    $activee = strtotime("now");
    
    if (empty($username) || empty($pwd)) {
        # check if the nywila is empyt or simu
        // $message = 'Jaza fomu yote!';
        // echo $message;
        echo "<script> alert('Username or Password Can't be empty!');window.location.assign('login.php');</script>";
        // exit();
    }else {
        // check if the users is in the database 
            $users = $mysqli->query("SELECT * FROM users WHERE users_name = '$username' && users_deleted = 0 && users_status = 1");
            $usersCheck = mysqli_num_rows($users);
          if ($usersCheck < 1) {
//   user does not exist
        echo "<script> alert('Username Does not exist or Account has been suspended!');window.location.assign('login.php');</script>";

          // exit();
           }else{
            //    change the value from database into  an array 
                if ($row = $users->fetch_assoc()) {
                    # code...
                //    select the user informatin and verfy 
                    $userID = $row['users_id'];
                    $users_name = $row['users_name'];
                    $users_status = $row['users_status'];
                    $users_role = $row['users_role']; 
                    $users_eid = $row['employeeID'];
                    
                    $passVery = password_verify($pwd,$row['users_password']);
                    if ($passVery == false) {
                        # code...
                        // password is incorrect 
        echo "<script> alert('Password is not correct!');window.location.assign('login.php');</script>";

                        // exit();
                    }elseif ($passVery == true) {
                        # Session generation...
                        # login the user to the system ...
                            $_SESSION['USERID'] = $userID;
                            $_SESSION['USERNAME'] = $users_name;
                            $_SESSION['STATUS'] = $users_status;
                            $_SESSION['ROLE'] = $users_role;
                            $_SESSION['EMPLOYEEID'] = $users_eid;
                        // check if status is active and rederict based on permission
                        if($row['users_status'] == 1 && $row['employeeID'] >= $activee){
						if($row['users_role'] == 1){
                             $message = "Admin";
                            echo "<script> alert('Welcome ADMIN to Biisoft F&B!');window.location.assign('index.php');</script>";
                            //  header("location: index.php?success=$message");
                            // exit();
                        }elseif ($row['users_role'] == 2) {
                            # code...
                        $message = "Accountant";
                        echo "<script> alert('Welcome Accountant to Biisoft F&B!');window.location.assign('sales.php');</script>";

                            //  header("location: sales.php?success=$message");
                            // exit();
                        }elseif ($row['users_role'] == 3) {
                          # code...
                        $message = "Cashier";
                        echo "<script> alert('Welcome Cashier to Biisoft F&B!');window.location.assign('pos.php');</script>";

                        //    header("location: pos.php?success=$message");
                        //     exit();
                        }
                    }else{
                        // Suspended accounts list 
        echo "<script> alert('Your Account has been suspended!');window.location.assign('login.php');</script>";
                        exit();
                    }

                    }



                }
           }
    }
}


// include header here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo MAIN_URL; ?>/css/main.css">
    <link rel="stylesheet" href="<?php echo MAIN_URL; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo MAIN_URL; ?>/css/dataTables.bootstrap.min.css">
<link rel="Shortcut Icon" href="favicon.ico">
<link rel="icon" type="image/png" href="<?php echo MAIN_URL; ?>/images/favicon.png">
  <title>Biisoft - F&B</title>
</head>
<body id="bgLogin">
    <div class="container">
       	<p>&nbsp;</p>
       	<div class="row">
       		<div class="col-md-3">
       			<?php 
// check if the success 
      if (isset($_GET['success'])) {
        # code...
        $msg = $_GET['success'];
        echo "<script> alert('{$msg}, please login to get started')</script>";
        // exit();
      }
             ?>
       		</div>
       		<div class="col-md-6 card" id="loginDiv">

       		<center><h1 class="h1">Biisoft <sup>F&B</sup></h1>
            <small class="text-white bg-dark">"&nbsp;Restaurant Management Made Easy!&nbsp;"</small>
       			<!-- <small>Please login to get started</small> -->
       		</center>
       		<form method="POST" action="">
       			<label for="username">Username</label>
       			<input id="username" class="form-control" type="text" name="username" placeholder="Enter your Username" required >
       			<label for="password">Password</label>
       			<input id="password" class="form-control" type="password" name="pwd" placeholder=" ************ " required>
       			<br>
       			<p><input type="submit" name="login" class="btn btn-small btn-info btn-block" value="Login"></p>
       		</form>
       		</div>

       		<div class="col-md-3">
       			
       		</div>
       	</div>
    </div>
   
  <?php
        include "includes/footer.php";
?>