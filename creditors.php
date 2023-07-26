<?php 
session_start();
include "includes/start.php";
// other code goes here


// CHECK IF THE USER IS LOGIN IN THE DISPLAY THE PAGE CONTENT
// <?php 
 if ($_SESSION['ROLE'] == 1 || $_SESSION['ROLE'] == 2) {
 	# code...
 
	

// include header here
include "includes/header.php";

?>
    <div class="container">
      <div class="row">
        <div class="col-md-1">
          <!-- left -->
          <?php 
                    if(isset($_GET['msg'])){
                  $msg = $_GET['msg'];
                      // echo "<script> alert('Debt is  completed successfully')</script>";
                      echo "<script> alert('{$msg}')</script>";

                }
          ?>
        </div>
        <div class="col-md-10">
          
      <h3 class="float-left">LIst of Creditors</h3> 
      <?php
      if ($_SESSION['ROLE'] == 1 || $_SESSION['ROLE'] == 2 ){
      ?>
<a href="sales.php" class="float-right"> << Back to Reports</a>
      <?php
        }else{
          // echo "sisi";
        }
      ?>
    
     <br>
<p><input type="search" oninput="w3.filterHTML('#searchStore','.item',this.value)" placeholder="Search Creditors" class="form-control"></p>
<div id="storePrint">
 <center> <h4 id="titleHeading4"></h4></center>
<table class="table table-hover table-responsive" id="searchStore">
  <thead>
   <tr>
      <th>Ref Number</th>
    <th>Name or Room</th>
    <th>QTY</th>
    <th>Total</th>
    <th>Amount to be paid</th>
    <th>Total Returns</th>
    <th>Debt</th>
    <th>Date issued</th>
    <th>Issued by</th>

    <th>
      <button class="btn btn-small btn-dark" onClick="printedText4(),printdiv('storePrint');">Print</button>
      
    </th>
   </tr>
  </thead>
  <tbody>
    <?php 
$creditors = $mysqli->query(
  "SELECT creditors_id,refNumber,full_name,dept_to_pay,total,qty,date_issued,issued_by,creditors_returns,time_issued,creditors_status FROM creditors WHERE deleted = 0 && creditors_status = 0 ORDER BY creditors_id DESC") or die("ERROR 5000");
    while($rows = $creditors->fetch_assoc()):


     ?>
   <tr class="item">
  <td><?php echo $rows['refNumber']; ?></td>
  <td><?php echo $rows['full_name']; ?></td>
  <td><?php echo $rows['qty']; ?></td>
  <td><?php echo $rows['total']." TZs"; ?></td>
  <td><?php echo $rows['dept_to_pay']." TZs"; ?></td>

  <td><?php echo $rows['creditors_returns']." TZs"; ?></td>
  <td><?php echo $rows['dept_to_pay']-$rows['creditors_returns']." TZs"; ?></td>
  <td><?php 
$date = strtotime($rows['date_issued']);
$time = $rows['time_issued'];
echo date('M d Y',$date);
echo '&nbsp;&nbsp;&nbsp;';
echo date('H:s:i A',$time);
   ?></td>
  <td><?php echo $rows['issued_by']; ?></td>
<td><a href="creditorsReturns.php?id=<?php echo $rows['creditors_id'];?>" class="btn btn-info">Enter returns</a></td>
   </tr>
   <?php 
    endwhile;

  ?>
                
  </tbody>
</table>
</div>

        </div>
        <div class="col-md-1">
          <!-- right -->
        </div>
      </div>
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