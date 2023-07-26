<?php 
session_start();

include "includes/start.php";
// other code goes here

// MAKE PAYMENT 
if (isset($_POST['pay'])) {
	# code...
	$discount = $mysqli->escape_string($_POST['discount']);
	$orderQTY = $mysqli->escape_string($_POST['orderQTY']);
	$orderTotal = $mysqli->escape_string($_POST['orderTotal']);
	$amount = $mysqli->escape_string($_POST['amount']);
	$payMethod = $mysqli->escape_string($_POST['payMethod']);
    // $cName = $mysqli->escape_string($_POST['cName']);

	$time = time();
   #date format 2019-12-02
   $date = date('Y-m-d',$time);
   $salesBy = $_SESSION['USERNAME'];
   $tableID2 = $_SESSION['TABLEID'];
	// sales id
	$salesID = "d".date('YmdHis',$time);

	// CALCULATING THE DISCOUNT
	$newTotal = $orderTotal - $discount;
	// chage
	
	// check if the amount is empty the display error
	if (empty($amount) || empty($payMethod)) {
		# code...
        echo "<script> alert('Fill required field!')</script>";

	}
// check if the amount entered is equal to newtotal
	elseif ($amount < $newTotal || $amount > $newTotal) {
		# code...
        echo "<script> alert('Amount is less or highter than the product Total!')</script>";

	}
	elseif (!is_numeric($amount)) {
		# code...
        echo "<script> alert('Please enter a number!')</script>";

	}
	else{
	$change = $amount - $newTotal;
// SELECT SUM OF PROFIT FROM TABLEITEMS
    $selectSUMprofit = $mysqli->query("SELECT SUM(item_profitPerPc) AS qProfit 
        FROM tableItems WHERE issued_by = '$salesBy' AND item_dlt = 0 AND tables_ID = '$tableID2'") or die(mysqli_error($mysqli));
$pcProfit = $selectSUMprofit->fetch_assoc();
// echo $pcProfit['qProfit'];
$qProfit = $pcProfit['qProfit'];
// get VAT
$selectVAT = $mysqli->query("SELECT SUM(item_VAT) AS VAT 
        FROM tableitems WHERE issued_by = '$salesBy' AND item_dlt = 0 AND tables_ID = '$tableID2'") or die(mysqli_error($mysqli));
$VAT = $selectVAT->fetch_assoc()['VAT'];
// echo $VAT;
		// insert sales into sales table
$sql = ("INSERT INTO sales(
sales_paymentMethod,sales_refNumber,sales_discount,sales_paid,sales_total,sales_balance,sales_qty,sales_date,sales_isssed_by,sales_time,sales_totalNProfit,sales_VAT) 
	VALUES('$payMethod','$salesID','$discount','$amount','$orderTotal','$change','$orderQTY','$date','$salesBy','$time','$qProfit','$VAT')") or die(mysqli_error($mysqli));
// get the last inserte id so that can be used on inserting salesDetails
if ($mysqli->multi_query($sql) === True) {
	# code...
	$lastID = $mysqli->insert_id;
	// echo $lastID;
}else{
	 // echo "Error: " . $sql . "<br>" . $mysqli->error;

}
// INSERT SALES ITEMS ON SALESDETAILS TABLE BY SELECTING FROM ORDERS TABLE

$orders = $mysqli->query("SELECT * FROM tableItems  WHERE issued_by = '$salesBy' AND item_dlt = 0 AND tables_ID = '$tableID2'") or die(mysqli_error($mysqli));
// loop orders and convert them into assoc array 
while($data = $orders->fetch_assoc()):
	$pname = $data['item_name'];
	$pcat = $data['item_cat'];
	$pqty = $data['item_qty'];
	$pprice = $data['item_price'];
	$ptotal = $data['item_total'];
	// insert into salesDetails table
	$mysqli->query("INSERT INTO salesDetails(
		salesDetails_name,salesDetails_cat,salesDetails_qty,salesDetails_price,salesDetails_total,salesDetails_saledID) 
		VALUES('$pname','$pcat','$pqty','$pprice','$ptotal','$lastID')") or die("ERROR 5000aaa");
endwhile;
// check if the user select creditors
if ($payMethod == 'credit') {
    # code...
// INSERT INTO CREDITORS TABLE
$mysqli->query("INSERT INTO creditors(refNumber,full_name,discount,dept_to_pay,total,qty,date_issued,issued_by,time_issued)
VALUES ('$salesID','$cName','$discount','$amount','$orderTotal','$orderQTY','$date','$salesBy','$time')") or die(mysqli_error($mysqli));
// DELETE INSERT ORDER
$mysqli->query("DELETE FROM  tableItems  WHERE issued_by = '$salesBy' AND item_dlt = 0 AND tables_ID = '$tableID2'") or die("ERROR 5000");
// DELETE KOT AND BOT FROM THIS TABLE 
$mysqli->query("DELETE FROM  kot WHERE tables_ID = $tableID2") or die("ERROR 5000");
$mysqli->query("DELETE FROM  bot WHERE tables_ID = $tableID2") or die("ERROR 5000");


header("location: print.php?ready=$lastID");
 exit();
}else{
// DELETE INSERT ORDER
$mysqli->query("DELETE FROM  tableItems  WHERE issued_by = '$salesBy' AND item_dlt = 0 AND tables_ID = '$tableID2'") or die("ERROR 5000");
header("location: print.php?ready=$lastID");
 exit();
}
	}

}

// CREDIT 

// MAKE PAYMENT  BY CREDIT
if (isset($_POST['credit'])) {
	 # code...
    // $discount = $mysqli->escape_string($_POST['discount']);
    $orderQTY = $mysqli->escape_string($_POST['orderQTY']);
    $orderTotal = $mysqli->escape_string($_POST['orderTotal']);
    // $amount = $mysqli->escape_string($_POST['amount']);
    $payMethod = $mysqli->escape_string($_POST['payMethod']);
    $cName = $mysqli->escape_string($_POST['cName']);

    $time = time();
	$tableID2 = $_SESSION['TABLEID'];

   #date format 2019-12-02
   $date = date('Y-m-d',$time);
   $salesBy = $_SESSION['USERNAME'];
    // sales id
    $salesID = "d".date('YmdHis',$time);

    // CALCULATING THE DISCOUNT
    // $newTotal = $orderTotal - $discount;

    // echo $newTotal;
    // chage
    
    // check if the amount is empty the display error
    if (empty($cName) || empty($payMethod)) {
        # code...
        echo "<script> alert('Fill required field!')</script>";

    }
    else{
    $change = $amount - $newTotal;
// SELECT SUM OF PROFIT FORM ORDERS
    $selectSUMprofit = $mysqli->query("SELECT SUM(item_profitPerPc) AS qProfit 
        FROM tableItems WHERE issued_by = '$salesBy' AND item_dlt = 0 AND tables_ID = '$tableID2'") or die("ERROR 5000");
$pcProfit = $selectSUMprofit->fetch_assoc();
// echo $pcProfit['qProfit'];
$qProfit = $pcProfit['qProfit'];
// get VAT
$selectVAT = $mysqli->query("SELECT SUM(item_VAT) AS VAT 
        FROM tableitems WHERE issued_by = '$salesBy' AND item_dlt = 0 AND tables_ID = '$tableID2'") or die("ERROR 5000");
$VAT = $selectVAT->fetch_assoc()['VAT'];
// echo $VAT;
        // insert sales into sales table
$sql = ("INSERT INTO sales(
sales_paymentMethod,sales_refNumber,sales_discount,sales_paid,sales_total,sales_balance,sales_qty,sales_date,sales_isssed_by,sales_time,sales_totalNProfit,sales_VAT) 
    VALUES('$payMethod','$salesID',0,'$orderTotal','$orderTotal',0,'$orderQTY','$date','$salesBy','$time','$qProfit','$VAT')") or die(mysqli_error("ERROR 5000"));
// get the last inserte id so that can be used on inserting salesDetails
if ($mysqli->multi_query($sql) === True) {
    # code...
    $lastID = $mysqli->insert_id;  
    // echo $lastID;
}
else{
     // echo "Error: " . $sql . "<br>" . $mysqli->error;

}
// INSERT SALES ITEMS ON SALESDETAILS TABLE BY SELECTING FROM ORDERS TABLE
// FIRST SELECT * FROM ORDERS 
$orders = $mysqli->query("SELECT * FROM tableItems  WHERE issued_by = '$salesBy' AND item_dlt = 0 AND tables_ID = '$tableID2'") or die(mysqli_error($mysqli));
// loop orders and convert them into assoc array 
while($data = $orders->fetch_assoc()):
    $pname = $data['item_name'];
    $pcat = $data['item_cat'];
    $pqty = $data['item_qty'];
    $pprice = $data['item_price'];
    $ptotal = $data['item_total'];
    // insert into salesDetails table
    $mysqli->query("INSERT INTO salesDetails(
        salesDetails_name,salesDetails_cat,salesDetails_qty,salesDetails_price,salesDetails_total,salesDetails_saledID) 
        VALUES('$pname','$pcat','$pqty','$pprice','$ptotal','$lastID')") or die("ERROR 5000");
endwhile;
// check if the user select creditors
if ($payMethod == 'credit') {
    # code...
// INSERT INTO CREDITORS TABLE
$mysqli->query("INSERT INTO creditors(refNumber,full_name,dept_to_pay,total,qty,date_issued,issued_by,time_issued)
VALUES ('$salesID','$cName','$orderTotal','$orderTotal','$orderQTY','$date','$salesBy','$time')") or die(mysqli_error($mysqli));
// DELETE INSERT ORDER
$mysqli->query("DELETE FROM  tableItems  WHERE issued_by = '$salesBy' AND item_dlt = 0 AND tables_ID = '$tableID2'") or die("ERROR 5000");

header("location: print.php?ready=$lastID");
 exit();
}else{
// DELETE INSERT ORDER
$mysqli->query("DELETE FROM  tableItems  WHERE issued_by = '$salesBy' AND item_dlt = 0 AND tables_ID = '$tableID2'") or die("ERROR 5000");

header("location: print.php?ready=$lastID");
 exit();
}
    }

}

// START OF CLOSE THE TABLE 
	if (isset($_POST['closeTable'])) {
		# code...
		$table_id = $_GET['table'];
		// echo $table_id;
		// $allTables = $mysqli->query("SELECT * FROM `tables` WHERE table_id = '$table_id'") or die("Error 5000");
		$mysqli->query("UPDATE tables SET table_status = 0 WHERE table_id = '$table_id'") or die(mysqli_error($mysqli));
		echo "<script>alert('Table Closed Successfully!'); window.location.assign('tables.php');</script>";
	}

	

// include header here
include "includes/header.php";
if ($_SESSION['ROLE'] == 1 || $_SESSION['ROLE'] == 3) {
    # code...
?>
<div class="container">
    
    <a href="kot.php" class="btn btn-small btn-white float-right">|&nbsp; KITCHEN ORDER TICKETS</a>
    <a href="bot.php" class="btn btn-small btn-white float-right">| &nbsp; BAR ORDER TICKETS</a>
    <a href="pos.php" class="btn btn-small btn-white float-right">| &nbsp; BACK TO POS</a>

    <a href="tables.php" class="btn btn-small btn-white float-right">BACK TO TABLES</a>



 
<br>
       <div class="container">
<?php 
		if (isset($_GET['table'])) {
		    # code...
		    $tableGET= $_GET['table'];
			$_SESSION['TABLEID'] = $tableGET;
			$selectTableName = $mysqli->query("SELECT table_number FROM tables WHERE table_id = $tableGET") or die("error select");
			
		}

?>
       	<h2 class="h4">ORDERS FROM TABLE #<?php echo  $selectTableName->fetch_assoc()['table_number'];?></h2>

<div class="row">
	<div class="col-md-8 card">
    <table class="table table-responsive">
        			<thead>
        				
        				<tr>
								<th>
									Select
								</th>
        						<th>
        							Product Name
        						</th>
        						
        						<th>
        							QTY
        						</th>
        						<th>
        							Price
        						</th>
        						<th>
        							Total
        						</th>
                                <th>
        							Recorded By
        						</th>
                                <th>
        							Saved By
        						</th>
        						<th>
        							
        						</th>
        					
        				</tr>
        				</thead>
        				<tbody>
        					<!-- Orders list -->
        					<?php 
							$orderBy = $_SESSION['USERNAME'];
						$selectOrders = $mysqli->query("SELECT * FROM tableitems WHERE item_dlt = 0 AND tables_ID = '$tableGET'") or die(mysqli_error($mysqli));
						$ordersCount = mysqli_num_rows($selectOrders);
						if ($ordersCount > 0) {
							# display the orders...
						while($rows = $selectOrders->fetch_assoc()):
					?>
        					<!-- End of Orders list -->
        					<tr>
								<td>
									<form action="kotandbot.php" method="POST">
										<input type="checkbox" name="orders[]" id="orderTicket" value="<?php echo $rows['tableItems_id'];?>">
									
								</td>
								
        						<td><?php echo $rows['item_name'];?></td>
        						<td><center><?php echo $rows['item_qty'];?></center></td>
        						<td><?php echo $rows['item_price'];?></td>
        						<td><?php echo $rows['item_total'];?></td>
        						<td><?php echo $rows['issued_by'];?></td>
                                <td><?php echo $rows['item_savedby'];?></td>
        						<td>
								<?php
    
    if ($_SESSION['ROLE'] == 1){
    ?>	
								<a href="includes/tableordersdelete.php?delete=<?php echo $rows['tableItems_id'];?>" class="btn btn-danger" onClick = "return confirm('Are you sure you want to Cancel?')">x</a>
							<?php
	}
	?>
							</td>

        					</tr>
        					<?php 
        					endwhile;
						}else{
							?>
							<tr>
								<td>No Orders on this Table!</td>
							</tr>
							<?php

						}

        					 ?>
							 
							
        				</tbody>
						
        			</table>
					<table border=0>
						<tr>
							<td>
	<?php
	$tableID= $_GET['table'];
	$allTables = $mysqli->query("SELECT table_status FROM tables WHERE table_id = '$tableID'") or die(mysqli_error($mysqli));
	$allTablesFetch = $allTables->fetch_assoc();
	$tableItems = $mysqli->query("SELECT COUNT(tableitems.item_name) AS totalItems FROM tables,tableitems WHERE tables.table_id = tableitems.tables_ID AND tableitems.tables_ID = '$tableID' AND item_dlt = 0;") or die("Error");
   $tableItemsTotal = $tableItems->fetch_assoc();
if ($tableItemsTotal['totalItems'] > 0) {
	# code...
	$selectOrders = $mysqli->query("SELECT * FROM tableitems WHERE item_dlt = 0 AND tables_ID = '$tableGET'") or die(mysqli_error($mysqli));
	$orderUserCheck = $selectOrders->fetch_assoc()['issued_by'];
	$orderUser = $_SESSION['USERNAME'];
	if ($orderUserCheck == $orderUser) {
		# code...

	
?>
	<input type="submit" name="kot" value="GENERATE KOT" class="btn btn-small btn-warning">
	<input type="submit" name="bot" value="GENERATE BOT" class="btn btn-small btn-warning">

<?php
	}
}
	?>
							</td>
							<td>

							</td>
						</tr>
					</table>

					</form>
					<!-- End of Kitchen Order Ticket -->

<!-- show total -->
<div>
<?php
        			if ($ordersCount !== 0) {
        			?>
<!-- form start  -->
<form method="POST" action="">	
        					<?php 
    $issuedByNew = $_SESSION['USERNAME'];
	$tableIDID = $_SESSION['TABLEID'];

        $selectOrders = $mysqli->query("SELECT SUM(item_qty) AS qty,SUM(item_total) AS total FROM tableitems WHERE item_dlt = 0 AND tables_ID = $tableIDID ") or die("ERROR 5000a");
        						 $rows = $selectOrders->fetch_assoc();
        					 ?>
<h5>Total Items : <?php echo $rows['qty'];?></h5>
<h5 id="totla_s">Total : <?php echo $rows['total']." TZs";?></h5>
<h5>Discount : <input type="number" name="discount" id="discount" value="0" class="inputMd"></h5>

<!-- </form> -->
<!-- START OF MODAL PAY -->
<div id="pay" class="modal fade" role="dialog">
        						<div class="modal-dialog">
        		<div class="modal-content">
        		<div class="modal-header">
        		<h4 class="h4">Make Payment</h4>
        		</div>
        		<div class="modal-body">
        		<input type="hidden" name="orderQTY"
        									value="<?php echo $rows['qty'];?>">
        		<input type="hidden" name="orderTotal"
        									value="<?php echo $rows['total'];?>">
        		<label for="payd">Select Payment Method</label>
        		<select id="payd" name="payMethod" class="form-control">
        		<option value="cash">CASH</option>
        		<!-- <option value="credit">CREDIT</option> -->


        		</select>
               <!--  <label for="cName">Customer name or Room</label>

                <input id="cName" type="text" name="cName" class="form-control" required
                placeholder="Enter Customer name or Room Number">
 -->
        				<br>
        <input type="text" name="amount" class="form-control" placeholder="Enter Amount" id="th_amount" required>
        	<br>
        		<input type="submit" class="btn btn-small btn-info" name="pay" value="Make Payment">
        		</div>
        		<div class="btn btn-default " data-dismiss="modal">
        		<p class="float-right text-danger">&times; Close</p>
        		</div>
        		</div>
        		</div>
        						
        		</div>
				
				
        					
        		</form>	

<!-- END OF MODAL PAY -->


<!-- START OF MODAL CREDIT -->
<form method="POST" action="">  
                            <?php 
        $issbyme = $_SESSION['USERNAME'];
        $selectOrders = $mysqli->query("SELECT SUM(item_qty) AS qty,SUM(item_total) AS total FROM tableitems WHERE item_dlt = 0 AND tables_ID = $tableIDID ") or die("ERROR 5000a");
        
        $rows = $selectOrders->fetch_assoc();

                             ?>
<div id="credit" class="modal fade" role="dialog">
        						<div class="modal-dialog">
        		<div class="modal-content">
        		<div class="modal-header">
        		<h4 class="h4">Add Creditors</h4>
        		</div>
        		<div class="modal-body">
        		<input type="hidden" name="orderQTY"
                                            value="<?php echo $rows['qty'];?>">
    <input type="hidden" name="orderTotal"
                                            value="<?php echo $rows['total'];?>">
                <label for="payd">Select Payment Method</label>
                <select id="payd" name="payMethod" class="form-control">
                <option value="credit">CREDIT</option>
        		<!-- <option value="credit">CREDIT</option> -->
        		</select>
				<label for="cName">Customer name or Room</label>

<input id="cName" type="text" name="cName" class="form-control" required
placeholder="Enter Customer name or Room Number">
        				<br>
        <!-- <input type="text" name="amount" class="form-control" placeholder="Enter Amount" required> -->
        	<br>
			<input type="submit" class="btn btn-small btn-info" name="credit" value="Submit">        		</div>
        		<div class="btn btn-default " data-dismiss="modal">
        		<p class="float-right text-danger">&times; Close</p>
        		</div>
        		</div>
        		</div>
        						
        		</div>
				
				
        					
        		<!-- </form>	 -->

<!-- END OF MODAL CREDIT -->

<!-- ALL BUTTONS  -->
<?php
$selectOrders = $mysqli->query("SELECT * FROM tableitems WHERE item_dlt = 0 AND tables_ID = '$tableGET'") or die(mysqli_error($mysqli));
$orderUserCheck = $selectOrders->fetch_assoc()['issued_by'];
$orderUser = $_SESSION['USERNAME'];
if ($orderUserCheck == $orderUser) {
	# code...

?>
<a href="bill.php?=tablebill=<?php echo $tableIDID;?>" class="btn btn-white"> PRINT BILL</a>	
<!-- pay button -->
<button data-toggle="modal" data-target="#pay" class="btn btn-small btn-info"  onclick = "fun()">PAY BY CASH</button>
<!-- credit button -->
<button data-toggle="modal" data-target="#credit" class="btn btn-small btn-dark float-right" onclick = "fun()" >PAY BY CREDIT</button>
 
<!-- END OF ALL BUTTONS -->

<?php
}
					}
					?>
	</div>
	<br>
	<br>
	<br>

	<!-- end of show total -->

					 <!-- clear table and close -->
					 <center>
					 <form action="" method="post">
						 <!-- if table as no orders show close button -->
<?php

 $tableID= $_GET['table'];
 $allTables = $mysqli->query("SELECT table_status FROM tables WHERE table_id = '$tableID'") or die(mysqli_error($mysqli));
 $allTablesFetch = $allTables->fetch_assoc();
 $tableItems = $mysqli->query("SELECT COUNT(tableitems.item_name) AS totalItems FROM tables,tableitems WHERE tables.table_id = tableitems.tables_ID AND tableitems.tables_ID = '$tableID' AND item_dlt = 0;") or die("Error");
$tableItemsTotal = $tableItems->fetch_assoc();
	if ($tableItemsTotal['totalItems'] == 0 && $allTablesFetch['table_status'] == 1) {
		# code...
	
?>
		<input type="submit" name="closeTable"  class="btn btn-large btn-warning" value="CLEAN AND CLOSE TABLE">
<br><br>
<?php
}
?>
								</form>
					</center>
	</div>
	<!-- <div id="space" class="col-md-1 bg-white text-white">
&nbsp;
</div> -->
	
	<div id="selesDetails" class="col-md-4 bg-info text-white">
		<center><p>Openned Tables</p></center>
		<center><h1 class="h1">
		<?php
    $tableTotal = $mysqli->query("SELECT COUNT(table_status) AS totalOpenned FROM tables WHERE table_deleted = 0 AND table_status = 1") or die("Error");

		echo $tableTotal->fetch_assoc()['totalOpenned'];
		?>
	</h1></center>
		<!-- <br> -->
		<center><p>Closed Tables</p></center>
		<center>
			<p>
				<h1 class="h2">
					<!-- 300 -->
                    <?php
    $tableTotal = $mysqli->query("SELECT COUNT(table_status) AS totalOpenned FROM tables WHERE table_deleted = 0 AND table_status = 0") or die("Error");

		echo $tableTotal->fetch_assoc()['totalOpenned'];
		?>
		</h1>
	</p>
	</center>
	
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