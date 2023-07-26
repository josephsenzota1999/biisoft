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
       	<p class="p">Reports - Sales</p>
<!-- reports nav -->
<?php
	include "includes/reportsNav.php";
?>
<p>&nbsp;</p>
<div class="row">

	<div class="col-md-9 card">
		<div id="printSalesCat">
			<center><h3 id="textCat">
				
			</h3></center>
		<table id="" class="table table-hover">
			<thead>
				<tr>
					<th>Category</th>
					<th>Total Sold</th>
					
					<th>
<button class="btn btn-dark float-right" onClick="catText(), printdiv('printSalesCat');">
				Print
			</button></th>


				</tr>

			</thead>
			<tbody>
				<?php 
$selectSalesCat = $mysqli->query("SELECT salesDetails.salesDetails_cat,COUNT(salesDetails.salesDetails_qty) AS qtySold FROM salesDetails WHERE salesDetails.salesDetails_dlt = 0 GROUP BY salesDetails.salesDetails_cat;
") or die("ERROR 5000");
					while($data = $selectSalesCat->fetch_assoc()):
				 ?>
				<tr>
					<td><?php echo $data['salesDetails_cat'];?></td>
					<td><?php echo $data['qtySold'];?></td>
					
					


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
	<div id="selesDetails" class="col-md-2 bg-info text-white">
		<center><p>Total Item Sold</p></center>
		<center><h1 class="h1">
		<?php
		$totalItems = $mysqli->query("SELECT SUM(salesDetails_qty) AS totalQTY FROM salesDetails WHERE salesDetails_dlt = 0") or die("ERROR 5000");
		echo $totalItems->fetch_assoc()['totalQTY'];
		?>
	</h1></center>
		<!-- <br> -->
		<center><p>Total Sales</p></center>
		<center>
			<p>
				<h1 class="h2">
<?php
		$totalItemsSold = $mysqli->query("SELECT SUM(sales_paid) AS totalSales FROM sales WHERE sales_deleted = 0") or die("ERROR 5000");
		echo $totalItemsSold->fetch_assoc()['totalSales']." TZs";
		?>
		</h1>
	</p>
	</center>
		<!-- sales by cash -->
	<center><p>Total sales by Cash</p></center>
		<center>
			<p>
				<h1 class="h2">
<?php
		$totalItemsSold = $mysqli->query("SELECT SUM(sales_paid) AS totalSales FROM sales WHERE sales_deleted = 0 && sales_paymentMethod = 'cash'") or die("ERROR 5000");
		echo $totalItemsSold->fetch_assoc()['totalSales']." TZs";
		?>
		</h1>
	</p>
	</center>
	<!-- sales by credit -->
	<center><p>Total sales by Credit</p></center>
		<center>
			<p>
				<h1 class="h2">
<?php
		$totalItemsSold = $mysqli->query("SELECT SUM(sales_paid) AS totalSales FROM sales WHERE sales_deleted = 0 && sales_paymentMethod = 'credit'") or die("ERROR 5000");
		echo $totalItemsSold->fetch_assoc()['totalSales']." TZs";
		?>
		</h1>
	</p>
	</center>
		
<center><p>Total Discount</p></center>
		<center>
			<p>
				<h1 class="h1">
<?php
		// SELECT SUM OF PROFIT FORM SALES
    $selectSUMdiscount = $mysqli->query("SELECT SUM(sales_discount) AS discount 
        FROM sales") or die("ERROR 5000");
$discount = $selectSUMdiscount->fetch_assoc();

// echo $pcProfit['qProfit'];
$sDiscount = $discount['discount'];
echo $sDiscount." TZs";
		?>
		</h1>
	</p>
	</center>
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