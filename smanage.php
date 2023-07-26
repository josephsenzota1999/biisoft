<?php 
session_start();
include "includes/start.php";
// other code goes here
// suspend the user
if (isset($_GET['status'])) {
$id = $_GET['status'];
if (!is_numeric($id)) {
  # code...
  echo "<script> alert('ERROR 5000!')</script>";
}else{
// Insert into the daabase
  $mysqli->query("UPDATE users SET users_status = 2 WHERE users_id = $id") or die("ERROR 5000");
  echo "<script> alert('Status Changed Sucessfully!')</script>";
}
}
// activate the user
if (isset($_GET['stat'])) {
$id = $_GET['stat'];
if (!is_numeric($id)) {
  # code...
  echo "<script> alert('ERROR 5000!')</script>";
}else{
// Insert into the daabase
  $mysqli->query("UPDATE users SET users_status = 1 WHERE users_id = $id") or die("ERROR 5000");
  echo "<script> alert('Status Changed Sucessfully!')</script>";
}
}
// Delete the user
if (isset($_GET['delete'])) {
$id = $_GET['delete'];
if (!is_numeric($id)) {
  # code...
  echo "<script> alert('ERROR 5000!')</script>";
}else{
// Insert into the daabase
  $mysqli->query("UPDATE users SET users_deleted = 1 WHERE users_id = $id") or die("ERROR 5000");
  echo "<script> alert('Stuff delete Sucessfully!')</script>";
}
}
// CHECK IF THE USER IS LOGIN IN THE DISPLAY THE PAGE CONTENT
// <?php 
 if ($_SESSION['ROLE'] == 1) {
 	# code...
 
	

// include header here
include "includes/header.php";
?>
<!-- changes div  -->
<?php 
if (isset($_GET['pwd'])) {
  # code...
  if (isset($_POST['changePass'])) {
  # code...
    $id = $_GET['pwd'];
  $pwd = $mysqli->escape_string($_POST['pwd']);
  $rePwd = $mysqli->escape_string($_POST['rePwd']);
if (empty($pwd) || empty($rePwd)) {
        # check if the nywila is empyt or simu
     
        echo "<script> alert('Fill all field!')</script>";
        // exit();
}else {
        if ($pwd != $rePwd) {
      # code...
        echo "<script> alert('Passwrod do not match!')</script>";
      // exit();
        }else{
          // hash the password
          $pwdHashed = password_hash($pwd,PASSWORD_BCRYPT);
          // Insert into the daabase
$mysqli->query("UPDATE users SET users_password = '$pwdHashed' WHERE users_id = $id") or die("ERROR 5000");
        echo "<script> alert('Passwrod Changed Sucessfully!')</script>";

        }

}
}
 ?>
<div class="container">
  <div class="row">
    <div class="col-md-4">
      <!-- left -->
    </div>
    <div class="col-md-4">
      <center>
        <h4>Change Password</h4>
        <br>
      </center>
      <form action="" method="POST">
        <label for="pwd">Enter new password:</label>
        <input id="pwd" type="password" name="pwd" placeholder=" *********** " required class="form-control">
        <label for="rePwd">Re-enter password:</label>
        <input id="rePwd" type="password" name="rePwd" placeholder=" *********** " required class="form-control">
        <br>
        <input type="submit" name="changePass" value="Change Password" class="btn btn-info btn-block">
      </form>
    </div>
    <div class="col-md-4">
      <!-- right -->
    </div>
  </div>
</div>
<?php 
}
?>
    <div class="container">
      	
       	<?php
	// include "includes/reportsNav.php";
?>
<br>
<h2 class="float-left">Staff Management</h2>
<!-- <p class="float-right">
  Total Active login users <button class="btn btn-success">
  <?php 
$totalVisits = $mysqli->query("SELECT COUNT(*) AS count FROM tracker") or die("ERROR 5000");
echo $totalVisits->fetch_assoc()['count'];
   ?>
</button>
</p> -->
<br>
<input oninput="w3.filterHTML('#searchActiv','.item',this.value)" 
class="form-control" type="search" placeholder="Search user activities">
<br>
<table class="table" id="searchActiv">
  <thead>
    <tr>
      <th>Username </th>
      <th>Status</th>
      <th>Role</th>
      <th>Password</th>
      <th colspan="3">Action</th>


    </tr>
  </thead>
  <tbody>
<?php 
  // select activities from the table
$selectActivities = $mysqli->query("SELECT * FROM `users` WHERE users_deleted = 0") or die("ERROR 5000");
while($data = $selectActivities->fetch_assoc()):
?>
    <tr class="item">
      <td><?php echo ucwords($data['users_name']); ?></td>
      <td><?php 
      if ($data['users_status'] == 1) {
        # code...
        echo "Active";
      }else{
        echo "Suspended";
      }
      
      ?></td>
      <td><?php
      if ($data['users_role'] == 1) {
        # code...
        echo "Admin";
      }elseif ($data['users_role'] == 2) {
        # code...
        echo "Accountant";

      }
      else{
        echo "Cashier";
      }
        ?></td>
      <td><?php echo "**********"; ?></td>
      <td>
<?php 
  // check if the user is admin do not show suspend or delete btn
if ($data['users_role'] == 1) {
  # code...
  ?>
<button class="btn btn-dark disabled">Suspend this stuff</button>
|
<a href="smanage.php?pwd=<?php echo $data['users_id'];?>" class="btn btn-info">Change Password</a>

|
<button class="btn btn-danger disabled">X</button>
<?php }
else{
  // change the btn class to info if the use is suspended
  if ($data['users_status'] == 1) {
    # code...
    ?>
    <a href="smanage.php?status=<?php echo $data['users_id'];?>" class="btn btn-dark">Suspend this stuff</a>
|
<?php
  }else{
?>
<a href="smanage.php?stat=<?php echo $data['users_id'];?>" class="btn btn-info">Activate this stuff</a>
|
<?php
  }
?>
<a href="smanage.php?pwd=<?php echo $data['users_id'];?>" class="btn btn-info">Change Password</a>
|
<a href="smanage.php?delete=<?php echo $data['users_id'];?>" class="btn btn-danger"
  onclick=" return confirm('Are you sure you want to delete?')">X</a>
<?php
}

 ?>
      </td>
    </tr>
<?php 
endwhile;
 ?>
  </tbody>
</table>
    </div>
   
  <?php
        include "includes/footer.php";
 }else{
 	   $message = "Access Denied!";
       header("location: login.php?success=$message");
       exit();
 }
 // end of session check

?>