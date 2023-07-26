<?php 
session_start();

include "includes/start.php";
// other code goes here
// DELETE THE ORDER 
if (isset($_GET['cancel'])) {
                    # code...
                    $id = $_GET['cancel'] ?? NULL;
					 
                    // echo $id;
                    // check if the $id is number
                    if (!is_numeric($id)) {
                        # code...
        echo "<script> alert('ERROR 5000')</script>";

                    }else{
                        // check the length of the id
                        if ($id >1000000) {
                            # code...
        echo "<script> alert('ERROR 5000')</script>";

                        }else{
                        	$user = $_SESSION['USERNAME'];
                        	$timeT = time();
// echo "ID: ".$id;
// 	echo "<br>";
 //SELECT PRODUCT NAME FROM ORDER TABLE SO THAT CAN BE USED TO UPDATE THE QTY WHEN DELETING 
$selectProductName = $mysqli->query("SELECT * FROM salesDetails WHERE salesDetails_saledID = $id") or die("ERROR 5000");
// SELECT sales_refNumber from sales table where sales id == $id
$salesRefNumber = $mysqli->query("SELECT sales_refNumber FROM sales WHERE sales_id = '$id'") or die("ERROR 5000");
$refNumber = $salesRefNumber->fetch_assoc()['sales_refNumber'];
//  loop through sales items and get the name
while ($data = $selectProductName->fetch_assoc()) {
	# code...
	$serviceName =  $data['salesDetails_name'];
	$productQty = $data['salesDetails_qty'];
	// echo "Name: ".$serviceName;
	// echo "<br>";
	// echo "QTY: ".$productQty;
	// echo "<br>";
	// echo "salesItemsID: ".$data['salesDetails_id'];
	// restore quantity of canceled product in product table
	$mysqli->query("UPDATE products SET products_qty = products_qty + $productQty  
WHERE products_name = '$serviceName'")or die("ERROR 5000");
// restore quantity of canceled product in store table
	$mysqli->query("UPDATE store SET instore = instore + $productQty,sold = sold - $productQty
	 WHERE product_name = '$serviceName'")or die("ERROR 5000");
	//  update sales table set deleted to 1
	$mysqli->query("UPDATE sales SET sales_deleted = 1, sales_dlt_date = '$timeT',
		sales_dlt_by = '$user' WHERE sales_id = $id") or die("ERROR 5000");
		// UPDATE CREDITORS TALBE SET DELETED TO 1
		$mysqli->query("UPDATE creditors SET deleted = 1, deleted_date = now(),
		deleted_by = '$user' WHERE refNumber = '$refNumber'") or die(mysqli_error($mysqli));
		// update sales details table set deleted to 1
		$mysqli->query("UPDATE salesDetails SET salesDetails_dlt = 1, salesDetails_dlt_time = '$timeT',
		salesDetails_dlt_by = '$user' WHERE salesDetails_saledID = $id") or die("ERROR 5000");


}
header("location: sales.php?msg= Canceled successfully!");
exit();
    }
}
}

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
	if (isset($_GET['msg'])) {
					# code...
					$text1 = $_GET['msg'];
					// echo $text1;
					echo "<script>alert('{$text1}')</script>";
				}
?>
<p>&nbsp;</p>
<div class="row">
	<div class="col-md-9 card">
		<form action="" method="POST">
			<label for="from" >FROM</label>
			<input type="date" name="from" class="" id="from"
				required placeholder="MM-DD-YYYY">
			<!-- </div><br> -->
			<label for="to" >TO</label>
			<input type="date" name="to" class="" id="to"
			required placeholder="MM-DD-YYYY">
			<!-- <br> -->
			<input type="submit" name="salesDates" value="Search" class="btn btn-info">
			<!-- </div> -->
		</form>

		<!-- <input type="text" placeholder="Search Sales here" class="form-control"><br> -->
		<?php 
			// check if the salesDates is set the show the results based on the dates
		if (isset($_POST['salesDates'])) {
			# code...
	$from = $mysqli->escape_string($_POST['from']);
	$to = $mysqli->escape_string($_POST['to']);
	// echo $from;
	// echo "<br>";
	// echo $to;
?>
<br>
<input type="search" oninput="w3.filterHTML('#searchSales','.item', this.value)" placeholder="Search sales here" class="form-control">
<br>
<div id="printSales1">
	<h3 id="textSales1">
		
	</h3>
<table id="searchSales" class="table table-responsive">
			<thead>
				<tr>
					<th>Sales Ref#</th>
					<th>Product Name</th>
					<th>Payment Method</th>
					<th>QTY</th>
					<th>Price</th>
					<th>Amount Paid</th>
					<th>Discount</th>
					<th>Balance</th>
					<th>Date</th>
					<th>Issued By</th>
					<th>
<button class="btn btn-dark" onClick="salesText(), printdiv('printSales1');">PRINT SALES</button>

					</th>

<th></th>
<th></th>
				</tr>

			</thead>
			<tbody>
				<?php 
				
					$selectSales = $mysqli->query("SELECT * FROM sales,salesdetails WHERE salesDetails_saledID = sales_id AND sales_deleted = 0 && sales.sales_date BETWEEN '$from' AND '$to' ORDER BY sales_id DESC;
") or die("ERROR 5000");
					while($data = $selectSales->fetch_assoc()):
				 ?>
				<tr class="item">
					<td><?php echo $data['sales_refNumber'];?></td>
										<td><?php echo $data['salesDetails_name'];?></td>

					<td><?php echo $data['sales_paymentMethod'];?></td>
					<td><?php echo $data['sales_qty'];?></td>
					<td><?php echo $data['sales_total']." TZs";?></td>
					<td><?php echo $data['sales_paid']." TZs";?></td>
					<td><?php echo $data['sales_discount']." TZs";?></td>
					<td><?php echo $data['sales_balance']." TZs";?></td>
					<td><?php 
					$date = strtotime($data['sales_date']);
					echo date('M d Y',$date);
					?></td>
					<td><?php echo $data['sales_isssed_by'];?></td>
					
					<td>
						<a href="print.php?ready=<?php echo $data['sales_id'];?>
						" class="btn btn-small btn-dark">Print</a>
						
					</td>

<td>
	<a href="salesItems.php?items=<?php echo $data['sales_id'];?>" class="btn btn-small btn-info">Items</a>
</td>
<td>
	<?php 
	if ($_SESSION['ROLE'] == 1){
		?>
		<a href="sales.php?cancel=<?php echo $data['sales_id'];?>" class="btn btn-small btn-danger" onclick=" return confirm('Are you sure you want to Cancel?')" > Cancel</a>
		<?php
	} ?>
						
	
</td>


				</tr>
				
				<?php 
				endwhile;
				 ?>
				 <tr>
					<td><h5>TOTAL</h5></td>
					<td class="borderTB"><u>
<?php 
#total of sales according to selected dates
$selectTotal = $mysqli->query("SELECT SUM(sales_paid) as sum FROM sales WHERE sales_deleted = 0 && sales.sales_date BETWEEN '$from' AND '$to';
") or die("ERROR 5000");
echo $selectTotal->fetch_assoc()['sum']." TZs";

// $selectedT = $mysqli->query("SELECT SUM(sales_paid) as sum, SUM(sales_qty) as qty FROM sales WHERE sales_deleted = 0 && sales.sales_date BETWEEN '$from' AND '$to'") or die("ERROR 5000");

?>
				</tr>


				<tr>  
<?php
$selecte = mysqli_query($mysqli,"SELECT SUM(sales_paid) as sum, SUM(sales_qty) as qty, SUM(sales_total) as total, SUM(sales_discount) as discount FROM sales WHERE sales_deleted = 0 && sales.sales_date BETWEEN '$from' AND '$to'");
if (mysqli_num_rows($selecte)>0) {
	while ($rows = mysqli_fetch_assoc($selecte)) {
		?>
		</u>
<table class="table table-striped table-hover" style="background: #17a2b8; position: relative;left:-10px;color: white;width: 800px">
		<thead>
			<th>Quantity</th>
						<th>Sales By Cash</th>
						<th>Sales Discount</th>

			<th>Total Sales</th>
			<th>From</th>
			<th>To</th>

		</thead>
		<tbody>
			<tr>
				<td><?php echo $rows['qty'];  ?></td>
				<td><?php echo $rows['total'];  ?> Tzs</td>
								<td><?php echo $rows['discount'];  ?> Tzs</td>

				<td><?php echo $rows['sum'];  ?> Tzs</td>
				<td><?php echo $from  ?></td>
								<td><?php echo $to  ?></td>




			</tr>
		</tbody>
	</table>
		<?php
	}
}

	?>
	
<?php	

?>


				</td>
				</tr>
			</tbody>
		</table>
</div>

<?php			
		}else{

		 ?>
<br>
<input type="search" oninput="w3.filterHTML('#searchSales1','.item', this.value)" placeholder="Search sales here" class="form-control">
<br>
<div id="printSales2">
	<h3 id="textSales2">
		
	</h3>
		<table id="searchSales1" class="table table-responsive">
			<thead>
				<tr>
										

					<th>Sales Ref#</th>
										<th>Product Name</th>

					<th>Payment Method</th>
					<th>QTY</th>
					<th>Price</th>
					<th>Amount Paid</th>
					<th>Discount</th>
					<th>Balance</th>
					<th>Date</th>
					<th>Issued By</th>
					<th>
<button class="btn btn-dark" onClick="salesText2(), printdiv('printSales2');">PRINT SALES</button>
						
					</th>
<th></th>
<th></th>

				</tr>

			</thead>
			<tbody>
				<?php 
					$selectSales = $mysqli->query("SELECT * from sales ,salesDetails WHERE salesDetails_saledID = sales_id") or die("ERROR 5000");
					while($data = $selectSales->fetch_assoc()):
				 ?>
				<tr class="item">
										

					<td><?php echo $data['sales_refNumber'];?></td>
					<td><?php echo $data['salesDetails_name'];?></td>
					<td><?php echo $data['sales_paymentMethod'];?></td>
					<td><?php echo $data['sales_qty'];?></td>
					<td><?php echo $data['sales_total']." TZs";?></td>
					<td><?php echo $data['sales_paid']." TZs";?></td>
					<td><?php echo $data['sales_discount']." TZs";?></td>
					<td><?php echo $data['sales_balance']." TZs";?></td>
					<td><?php 
					$date = strtotime($data['sales_date']);
					echo date('M d Y',$date);
					?></td>
					<td><?php echo ucwords($data['sales_isssed_by']);?></td>
					
					<td>
						<a href="print.php?ready=<?php echo $data['sales_id'];?>
						" class="btn btn-small btn-dark">Print</a>
						
					</td>

<td>
	<a href="salesItems.php?items=<?php echo $data['sales_id'];?>" class="btn btn-small btn-info">Items</a>
</td>
<td>
	<?php 
	if ($_SESSION['ROLE'] == 1){
		?>
		<a href="sales.php?cancel=<?php echo $data['sales_id'];?>" class="btn btn-small btn-danger" onclick=" return confirm('Are you sure you want to Cancel?')" > Cancel</a>
		<?php
	} ?>
						
	
</td>

				</tr>
				<?php 
				endwhile;
				 ?>
				 <tr>
					<td><h5>TOTAL</h5></td>
					<td class="borderTB"><u>
<?php 
#total of sales according to selected dates
$selectTotal = $mysqli->query("SELECT SUM(sales_paid) as sum FROM sales WHERE sales_deleted = 0;
") or die("ERROR 5000");
echo $selectTotal->fetch_assoc()['sum']." TZs";

?>
				</u></td>

				</tr>
			</tbody>
		</table>
	</div>
		<?php 
		} ?>
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
					<!-- 300 -->
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
				<h1 class="h4">
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
				<h1 class="h2">
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