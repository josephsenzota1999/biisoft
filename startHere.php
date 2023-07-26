<?php 
include "includes/start.php";
// other code goes here
if (isset($_POST['start'])) {
    # code...
    // echo "good pass"; 
    $username = $mysqli->escape_string($_POST['username']);
    $role = $mysqli->escape_string($_POST['role']);
    $pwd = $mysqli->escape_string($_POST['pwd']);
    $rePwd = $mysqli->escape_string($_POST['rePwd']);
    $status = $mysqli->escape_string($_POST['status']);

// echo $wazifa;

    // echo $jinalakwanza;
    if (empty($username) || empty($role) || empty($pwd) || empty($rePwd) || empty($status)) {
        # code...
        echo "<script> alert('All field are required!')</script>";
        exit();
    }else{
        // check the passwored do match 
        if ($pwd != $rePwd) {
            # code...
        echo "<script> alert('Passwrod do not match!')</script>";

            // exit();
        }else{
            // check if the username is taken 
            $users = $mysqli->query("SELECT * FROM users WHERE users_name = '$username' && users_deleted = 0");
                    // check if $districts has value
            $usersCheck = mysqli_num_rows($users);
            if ($usersCheck > 0) {
        echo "<script> alert('This username is taken!')</script>";
                
                exit();
            }else {
                # hash the password...
                $pwdHashed = password_hash($pwd,PASSWORD_BCRYPT);
    $employeeID  = strtotime("+6 months");
                // echo $pwdHashed;
                // iinsert into the database 
  $mysqli->query("INSERT INTO users(users_name,users_password,users_status,users_role,employeeID) 
                  VALUES('$username','$pwdHashed','$status','$role','$employeeID')") or die("BAD PASS!");
      $message = "Plase login!";
      header("location: login.php?success=$message");
      exit();
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
<body>
    <div class="container">
       	<p>&nbsp;</p>
       	<div class="row">
       		<div class="col-md-3">
       			
       		</div>
       		<div class="col-md-6">

       		<center><h1 class="h1">Biisoft <sup>F&B</sup></h1>
       			<small>Create Account to get started</small>
       		</center>
       		<form method="POST" action="">
       			<label>Username</label>
       			<input class="form-control" type="text" name="username" placeholder="Enter your Username" required >
            <label>Permission</label>
            <select name="role" class="form-control">
              <option></option>
              <option value="1">ADMIN</option>
              <option value="3">CASHIER</option>
              <option value="2">ACCOUNTANT</option>



            </select>
       			<label>Enter Password</label>
       			<input class="form-control" type="password" name="pwd" placeholder=" ************ " required>
            <label>Enter Password one more time</label>
            <input class="form-control" type="password" name="rePwd" placeholder=" ************ " required>
       			<label>Status</label>
            <select name="status" class="form-control">
              <option></option>
              <option value="1">ACTIVE</option>
              <option value="2">NOT ACTIVE</option>

            </select>
            <br>
       			<p><input type="submit" name="start" class="btn btn-small btn-info btn-block" value="+ Create Account"></p>
       		</form>
       		</div>

       		<div class="col-md-3">
       			
       		</div>
       	</div>
    </div>
   
  <?php
        include "includes/footer.php";
?>