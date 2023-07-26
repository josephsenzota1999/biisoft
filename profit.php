<?php 
session_start();

include "includes/start.php";
// other code goes here



// include header here
include "includes/header.php";
if ($_SESSION['ROLE'] == 1 || $_SESSION['ROLE'] == 2) {
    # code...
?>
       <div class="container">
       	<p class="p">Reports - VAT and CROSS PROFIT</p>
<!-- reports nav -->
<?php
	include "includes/reportsNav.php";
?>
<p>&nbsp;</p>
<div class="row">
	<div class="col-md-5 card">

<h2>DRINKS PRODUCT VAT</h2>

		<div id="printSalesCat">
			<center><h3 id="textCat1">
				
			</h3></center>
            
		<table id="" class="table table-hover">
			<thead>
				<tr>
					<th>Sales RefNumber</th>
					<th>Total VAT</th>
					
					<th>
<button class="btn btn-dark float-right" onClick="catText1(), printdiv('printSalesCat');">
				Print
			</button></th>


				</tr>

			</thead>
			<tbody>
				<?php 
$selectSalesCat = $mysqli->query("SELECT sales_refNumber,sales_VAT FROM `sales` WHERE sales_deleted = 0 ORDER BY sales_id DESC;
") or die("ERROR 5000");
					while($data = $selectSalesCat->fetch_assoc()):
				 ?>
				<tr>
					<td><?php echo $data['sales_refNumber'];?></td>
					<td><?php echo $data['sales_VAT'];?></td>
					
					


				</tr>
				<?php 
				endwhile;
				 ?>
			</tbody>
		</table>
		</div>
	
	</div>
	<div class="col-md-1">
		
	</div>

	<div class="col-md-6 card">

<h2>DRINKS GROSS PROFIT</h2>

		<div id="printSalesCat">
			<center><h3 id="textCat1">
				
			</h3></center>
            
		<table id="" class="table table-hover">
			<thead>
				<tr>
					<th>Date</th>
					<th> CROSS PROFIT</th>
					
					<th>
<button class="btn btn-success float-right">
<?php 
$selectSalesCat = $mysqli->query("SELECT SUM(sales_totalNProfit) AS crossP FROM `sales` WHERE sales_deleted = 0 ORDER BY sales_id DESC;
") or die("ERROR 5000");
echo $selectSalesCat->fetch_assoc()['crossP'];
?>
				
			</button></th>


				</tr>

			</thead>
			<tbody>
				<?php 
$selectSalesCat = $mysqli->query("SELECT sales_time,sales_totalNProfit FROM `sales` WHERE sales_deleted = 0 ORDER BY sales_id DESC;
") or die("ERROR 5000");
					while($data = $selectSalesCat->fetch_assoc()):
				 ?>
				<tr>
					<td><?php 
					$time =$data['sales_time'];
					echo date('Y M d H:i:s A',$time);
					?></td>
					<td><?php echo $data['sales_totalNProfit'];?></td>
					
					


				</tr>
				<?php 
				endwhile;
				 ?>
			</tbody>
		</table>
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