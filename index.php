<?php 
session_start();
include "includes/start.php";
// other code goes here


// CHECK IF THE USER IS LOGIN IN THE DISPLAY THE PAGE CONTENT
// <?php 
 if ($_SESSION['ROLE'] == 1) {
 	# code...
 
	

// include header here
include "includes/header.php";
?>
    <div class="container">
      	
 <p class="p">Reports - Dashboard</p>
       	<?php
	include "includes/reportsNav.php";
?>
<br>
<h2 class="float-left">List of System Activities</h2>
<p class="float-right">
  Total Visits <button class="btn btn-success">
  <?php 
$totalVisits = $mysqli->query("SELECT COUNT(*) AS count FROM tracker") or die(mysqli_error($mysqli));
echo $totalVisits->fetch_assoc()['count'];
   ?>
</button>
</p>
<br>
<input oninput="w3.filterHTML('#searchActiv','.item',this.value)" 
class="form-control" type="search" placeholder="Search user activities">
<table class="table" id="searchActiv">
  <thead>
    <tr>
      <th>Page name</th>
      <th>IP Address</th>
      <th>Time Visited</th>
      <th>Visited By</th>


    </tr>
  </thead>
  <tbody>
<?php 
  // select activities from the table
$selectActivities = $mysqli->query("SELECT * FROM `tracker` ORDER BY `tracker`.`tracker_id` DESC") or die(mysqli_error($mysqli));
while($data = $selectActivities->fetch_assoc()):
?>
    <tr class="item">
      <td><?php echo $data['page']; ?></td>
      <td><?php echo $data['ip']; ?></td>
      <td><?php 
      $time=$data['time'];
      echo date('M D Y H:i:s A') 
      ?></td>
      <td><?php echo $data['user']; ?></td>

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