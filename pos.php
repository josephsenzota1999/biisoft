<?php 
session_start();
include "includes/start.php";
// other code goes here
//$newTotal = 0;

// ADD ORDERS
if (isset($_POST['addOrder'])) {
	# code...
	$qty = $mysqli->escape_string($_POST['qty']);
	$pName = $mysqli->escape_string($_POST['pName']);
	$cat = $mysqli->escape_string($_POST['cat']);
	$price = $mysqli->escape_string($_POST['price']);
	$time = time();
	$issuedBy = $_SESSION['USERNAME'];
	$qtyPrice = $qty*$price;
// echo $qtyPrice;
// addOrder
// validate qty making sure no neg values and zero
if ($qty <= 0) {
	# output error...
	echo "<script> alert('Invalid input, 0 or Negative not allowed!')</script>";
}else{
	// check if the qty entered is less or equal to product qty
	// so that can avoid sell more than what you have instock 
$selectQTY = $mysqli->query("SELECT products_qty FROM products WHERE products_name = '$pName'") or die("ERROR 5000");
$dataQTY = $selectQTY->fetch_assoc()['products_qty'];
// echo $dataQTY;
// check if qty is less or = to dataqty
if ($dataQTY < $qty) {
	# code...
	echo "<script> alert('Reduce the quantity!')</script>";

}else{
// calculate the cross profit per qty 
    // 1 select prifit per @ pc form products table
$profitPerPc = $mysqli->query("SELECT products_profitPerPc FROM products WHERE products_name = '$pName'") or die("ERROR 5000");
$dataPProfit = $profitPerPc->fetch_assoc()['products_profitPerPc'];
// calculate the VAT
$VAT = ($qtyPrice/1.18)*0.18;

// cross profit
$theNP = ($dataPProfit * $qty) - $VAT; // this is cross profit

// echo $VAT;
	// INSERT INTO ORDERS
$sql = "INSERT INTO orders
	(orders_name,orders_cat,orders_qty,orders_price,orders_total,orders_time,issued_by,orders_profitPerPc,orders_VAT) 
	VALUES
	('$pName','$cat','$qty','$price','$qtyPrice','$time','$issuedBy','$theNP','$VAT')";
// update product qty by taking the product qty - qty that user input 
$sql1 ="UPDATE products SET products_qty = products_qty - $qty  WHERE products_name = '$pName'";
$sql2 = "UPDATE store SET instore = instore - $qty,sold = sold + $qty WHERE product_name = '$pName'";
 if ($mysqli->query($sql) === TRUE) {
         # code...
        $mysqli->query($sql1);
        $mysqli->query($sql2);  
header("location: pos.php");
            exit();

     }else{
        echo mysqli_error($mysqli);
     }
}

}


}
// ADD Product TO ORDER
if (isset($_POST['orderFood'])) {
    # code...
    $qty = $mysqli->escape_string($_POST['qty']);
    $pName = $mysqli->escape_string($_POST['pName']);
    $cat = $mysqli->escape_string($_POST['cat']);
    $price = $mysqli->escape_string($_POST['price']);
    $time = time();
    $issuedBy = $_SESSION['USERNAME'];
    $qtyPrice = $qty*$price;
// echo $qtyPrice;
// addOrder
// validate qty making sure no neg values and zero
if ($qty <= 0) {
    # output error...
    echo "<script> alert('Invalid input, 0 or Negative not allowed!')</script>";
}else{
    
$VAT = ($qtyPrice*18)/100;
$theNP = 0;
// echo $VAT;
    // INSERT INTO ORDERS
$sql = "INSERT INTO orders
    (orders_name,orders_cat,orders_qty,orders_price,orders_total,orders_time,issued_by,orders_profitPerPc,orders_VAT) 
    VALUES
    ('$pName','$cat','$qty','$price','$qtyPrice','$time','$issuedBy','$theNP','$VAT')";
// update product qty by taking the product qty - qty that user input 
 if ($mysqli->query($sql) === TRUE) {
         # code...
header("location: pos.php");
            exit();

     }else{
        echo mysqli_error($mysqli);
     }
}

}

// DELETE THE ORDER THEN UPDATE STORE (TAKE THE ODERDERD QTY AND RETURN IT TO THE STORE)
if (isset($_GET['delete'])) {
                    # code...
                    $id = $_GET['delete'] ?? NULL;
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

 //SELECT PRODUCT NAME FROM ORDER TABLE SO THAT CAN BE USED TO UPDATE THE QTY WHEN DELETING 
$selectProdctName = $mysqli->query("SELECT orders_name,orders_qty FROM orders WHERE orders_id = $id") or die("ERROR 5000");
$nameQty = $selectProdctName->fetch_assoc();
$productName = $nameQty['orders_name'];
$productQty = $nameQty['orders_qty'];

// UPDATE PRODUCT QTY

$sql = "UPDATE products SET products_qty = products_qty + $productQty  
WHERE products_name = '$productName'";
// UPDATE STORE QTY
$sql1 = "UPDATE store SET instore = instore + $productQty,sold = sold - $productQty 
WHERE product_name = '$productName'";
 $sql2 = "DELETE FROM orders WHERE orders_id = $id";
// 
 if ($mysqli->query($sql) === TRUE) {
         # code...
        $mysqli->query($sql1); #command to update store
        $mysqli->query($sql2); #command to delete the order
header("location: pos.php");
            exit();

     }else{
        echo mysqli_error($mysqli);
     
        }
    }
}
}

// MAKE PAYMENT 
if (isset($_POST['pay'])) {
	# code...
    global $discount;

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
	// sales id
	$salesID = "d".date('YmdHis',$time);

	// CALCULATING THE DISCOUNT
	$newTotal = $orderTotal - $discount;

    //global $newTotal;
	
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
    $_SESSION['change'] = $change;

// SELECT SUM OF PROFIT FORM ORDERS
    $selectSUMprofit = $mysqli->query("SELECT SUM(orders_profitPerPc) AS qProfit 
        FROM orders WHERE issued_by = '$salesBy'") or die("ERROR 5000");
$pcProfit = $selectSUMprofit->fetch_assoc();
// echo $pcProfit['qProfit'];
$qProfit = $pcProfit['qProfit'];
// get VAT
$selectVAT = $mysqli->query("SELECT SUM(orders_VAT) AS VAT 
        FROM orders WHERE issued_by = '$salesBy'") or die("ERROR 5000");
$VAT = $selectVAT->fetch_assoc()['VAT'];
// echo $VAT;
		// insert sales into sales table
$sql = ("INSERT INTO sales(
sales_paymentMethod,sales_refNumber,sales_discount,sales_paid,sales_total,sales_balance,sales_qty,sales_date,sales_isssed_by,sales_time,sales_totalNProfit,sales_VAT) 
	VALUES('$payMethod','$salesID','$discount','$amount','$orderTotal','$change','$orderQTY','$date','$salesBy','$time','$qProfit','$VAT')") or die(mysqli_error("ERROR 5000"));
// get the last inserte id so that can be used on inserting salesDetails
if ($mysqli->multi_query($sql) === True) {
	# code...
	$lastID = $mysqli->insert_id;
	// echo $lastID;
}else{
	 // echo "Error: " . $sql . "<br>" . $mysqli->error;

}
// INSERT SALES ITEMS ON SALESDETAILS TABLE BY SELECTING FROM ORDERS TABLE

$orders = $mysqli->query("SELECT * FROM orders  WHERE issued_by = '$salesBy'") or die("ERROR 5000");
// loop orders and convert them into assoc array 
while($data = $orders->fetch_assoc()):
	$pname = $data['orders_name'];
	$pcat = $data['orders_cat'];
	$pqty = $data['orders_qty'];
	$pprice = $data['orders_price'];
	$ptotal = $data['orders_total'];
	// insert into salesDetails table
	$mysqli->query("INSERT INTO salesDetails(
		salesDetails_name,salesDetails_cat,salesDetails_qty,salesDetails_price,salesDetails_total,salesDetails_saledID) 
		VALUES('$pname','$pcat','$pqty','$pprice','$ptotal','$lastID')") or die("ERROR 5000");
endwhile;
// check if the user select creditors
if ($payMethod == 'credit') {
    # code...
// INSERT INTO CREDITORS TABLE
$mysqli->query("INSERT INTO creditors(refNumber,full_name,discount,dept_to_pay,total,qty,date_issued,issued_by,time_issued)
VALUES ('$salesID','$cName','$discount','$amount','$orderTotal','$orderQTY','$date','$salesBy','$time')") or die(mysqli_error($mysqli));
// DELETE INSERT ORDER
$mysqli->query("DELETE FROM  orders  WHERE issued_by = '$salesBy'") or die("ERROR 5000");

header("location: print.php?ready=$lastID");
 exit();
}else{
// DELETE INSERT ORDER
$mysqli->query("DELETE FROM  orders  WHERE issued_by = '$salesBy'") or die("ERROR 5000");
header("location: print.php?ready=$lastID");
 exit();
}
	}

}
// MAKE CREDIT 
if (isset($_POST['credit'])) {
    # code...
    // $discount = $mysqli->escape_string($_POST['discount']);
    $orderQTY = $mysqli->escape_string($_POST['orderQTY']);
    $orderTotal = $mysqli->escape_string($_POST['orderTotal']);
    // $amount = $mysqli->escape_string($_POST['amount']);
    $payMethod = $mysqli->escape_string($_POST['payMethod']);
    $cName = $mysqli->escape_string($_POST['cName']);

    $time = time();
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
    $selectSUMprofit = $mysqli->query("SELECT SUM(orders_profitPerPc) AS qProfit 
        FROM orders WHERE issued_by = '$salesBy'") or die("ERROR 5000");
$pcProfit = $selectSUMprofit->fetch_assoc();
// echo $pcProfit['qProfit'];
$qProfit = $pcProfit['qProfit'];
// get VAT
$selectVAT = $mysqli->query("SELECT SUM(orders_VAT) AS VAT 
        FROM orders WHERE issued_by = '$salesBy'") or die("ERROR 5000");
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
$orders = $mysqli->query("SELECT * FROM orders WHERE issued_by = '$salesBy'") or die("ERROR 5000");
// loop orders and convert them into assoc array 
while($data = $orders->fetch_assoc()):
    $pname = $data['orders_name'];
    $pcat = $data['orders_cat'];
    $pqty = $data['orders_qty'];
    $pprice = $data['orders_price'];
    $ptotal = $data['orders_total'];
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
$mysqli->query("DELETE FROM  orders WHERE issued_by = '$salesBy'") or die("ERROR 5000");

header("location: print.php?ready=$lastID");
 exit();
}else{
// DELETE INSERT ORDER
$mysqli->query("DELETE FROM  orders WHERE issued_by = '$salesBy'") or die("ERROR 5000");
header("location: print.php?ready=$lastID");
 exit();
}
    }

}
// add order to the specific table and change the status of the table 
if (isset($_POST['addtoTable'])) {
    # code...
    $tableName = $mysqli->escape_string($_POST['table']);
    $holderName = $mysqli->escape_string($_POST['hName']);
    $issuedBy = $_SESSION['USERNAME'];

    // echo $holderName.' Holder Name';
// SELECT FROM ORDERS WHERE THE USER IS THE ONE LOGIN IN 
// check if the amount is empty the display error
if (empty($tableName) || empty($holderName)) {
    # code...
    echo "<script> alert('Fill required field!')</script>";

}else {
    // SELECT THE ITEMS AND THEM INSERT INTO TABLE ITEMS 
    $orders = $mysqli->query("SELECT * FROM orders  WHERE issued_by = '$issuedBy'") or die("ERROR 5000");
// loop orders and convert them into assoc array 
while($data = $orders->fetch_assoc()):
	$pname = $data['orders_name'];
	$pcat = $data['orders_cat'];
	$pqty = $data['orders_qty'];
	$pprice = $data['orders_price'];
	$ptotal = $data['orders_total'];
	$orders_time = $data['orders_time'];
	$issued_by = $data['issued_by'];
	$orders_profitPerPc = $data['orders_profitPerPc'];
	$orders_VAT = $data['orders_VAT'];

	// insert into teble itmes table
	$mysqli->query("INSERT INTO tableitems(
		item_name,item_cat,item_qty,item_price,item_total,item_time,
        issued_by,item_savedby,item_profitPerPc,item_VAT,tables_ID) 
		VALUES('$pname','$pcat','$pqty','$pprice','$ptotal','$orders_time',
        '$issued_by','$holderName','$orders_profitPerPc','$orders_VAT','$tableName')") or die(mysqli_error($mysqli));
endwhile;
// change the status of the table to 1 = closed
$mysqli->query("UPDATE tables SET table_status = '1' WHERE table_id = '$tableName'") or die("ERROR 5000");
// delete orders from the orders table 
$mysqli->query("DELETE FROM orders WHERE issued_by = '$issuedBy'") or die("ERROR 5000");
echo "<script> alert('Order Added Successfully!'); window.location.assign('tables.php');</script>";
}

}
// CHECK IF THE USER IS LOGIN IN THE DISPLAY THE PAGE CONTENT

 if ($_SESSION['ROLE'] == 1 || $_SESSION['ROLE'] == 3) {
    # code...

// include header here
include "includes/header.php";
?>
        <div class="container">
           <center>
			   <h3>POINT OF SELL</h3>
               <?php 
                echo "Welcome ".ucwords($_SESSION['USERNAME'])." :)";
                 ?>
           </center>
           <br>
        	<div class="row">
        		<!-- <div class="col-md-1 bg-white">
        			left
        		</div>
        		 -->
        		<div class="col-md-6 card" id="service_only">
        			<!-- Search Products -->
        			<br>
 <input type="search" id="pSearch" name="pSearch" class="form-control"
        			placeholder="Search From Menu here...." 
        			oninput="w3.filterHTML('#searchProduct','.item', this.value)" >
        			<br>
						<!-- product list -->
					<?php 
						$selectProducts = $mysqli->query("SELECT categories_name,products_name,products_price FROM products,categories WHERE categories_id = products_cat && products_deleted = 0 && products_status = 'active' && products_qty > 0") or die("ERROR 5000");
						$proCount = mysqli_num_rows($selectProducts);

						while($rows = $selectProducts->fetch_assoc()):
					?>
					<form method="POST" action="">
						<div id="searchProduct">	
						
						<p class="light-grey item"><?php echo $rows['products_name'];?> | <b><?php echo $rows['categories_name'];?></b>   | <input type="number" name="qty"
        				value="1" class="inputSmall" required> <?php echo $rows['products_price'];?> TZs &nbsp;&nbsp;
        				<input type="hidden" name="pName" value="<?php echo $rows['products_name'];?>">
        				<input type="hidden" name="cat" value="<?php echo $rows['categories_name'];?>">
        				<input type="hidden" name="price" value="<?php echo $rows['products_price'];?>">
        				<button type="submit" name="addOrder" class="btn btn-info">+</button></p>
        				</div>
					</form>
        			
        				<?php
        			endwhile;
                    // food menu here
                    $selectFood = $mysqli->query("SELECT categories_name,food_name,food_price FROM foodMenu,categories WHERE categories_id = food_cat && food_deleted = 0 && food_status = 'active'") or die("ERROR 5000");
                        // $proCount = mysqli_num_rows($selectProducts);

                        while($food = $selectFood->fetch_assoc()):
                            ?>
            <div>
                <form method="POST" action="">
                        <div id="searchProduct">    
                        
                        <p class="light-grey item"><?php echo $food['food_name'];?> | <b><?php echo $food['categories_name'];?></b>   | <input type="number" name="qty"
                        value="1" class="inputSmall"> <?php echo $food['food_price'];?> TZs &nbsp;&nbsp;
                        <input type="hidden" name="pName" value="<?php echo $food['food_name'];?>">
                        <input type="hidden" name="cat" value="<?php echo $food['categories_name'];?>">
                        <input type="hidden" name="price" value="<?php echo $food['food_price'];?>">
                        <button type="submit" name="orderFood" class="btn btn-info">+</button></p>
                        </div>
                    </form>

            </div>
                            <?php
                    endwhile;

        			if ($proCount == 0) {
        				# code...
        				echo "<p class='text-danger'>You have no Drinks in store!</p>";
        				// echo time();
        			}
        			?>
        				<!-- end of product list -->
        		</div>
        		<div class="col-md-1 bg-white">
        			<!-- center -->
        			
        		</div>
        		<div class="col-md-5 light-grey">

        			<!-- Orders -->
        			<h4 class="h4 float-left">List of Orders</h4>
        			<!-- if there is palace display this -->

        			<table class="table table-responsive">
        			<thead>
        				
        				<tr>
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
        							
        						</th>
        					
        				</tr>
        				</thead>
        				<tbody>
        					<!-- Orders list -->
        					<?php 
							$orderBy = $_SESSION['USERNAME'];
						$selectOrders = $mysqli->query("SELECT * FROM orders WHERE issued_by = '$orderBy'") or die(mysqli_error($mysqli));
						$ordersCount = mysqli_num_rows($selectOrders);
						if ($ordersCount > 0) {
							# display the orders...
						while($rows = $selectOrders->fetch_assoc()):
					?>
        					<!-- End of Orders list -->
        					<tr>
        						<td><?php echo $rows['orders_name'];?></td>
        						<td><center><?php echo $rows['orders_qty'];?></center></td>
        						<td><?php echo $rows['orders_price'];?></td>
        						<td><?php echo $rows['orders_total'];?></td>
        						<td><a href="pos.php?delete=<?php echo $rows['orders_id'];?>" class="btn btn-danger">x</a></td>

        					</tr>
        					<?php 
        					endwhile;
						}else{
							?>
							<tr>
								<td>No Orders to Display!</td>
							</tr>
							<?php

						}

        					 ?>
        				</tbody>
        			</table>
        			<!-- orders footer -->
        			<?php
        			if ($ordersCount !== 0) {
        			?>
        			<div id="total" class="card">
        				<div class="">
        					<form method="POST" action="">	
        					<?php 
                            $issuedByNew = $_SESSION['USERNAME'];
        $selectOrders = $mysqli->query("SELECT SUM(orders_qty) AS qty,SUM(orders_total) AS total FROM orders WHERE issued_by = '$issuedByNew'") or die("ERROR 5000");
        						 $rows = $selectOrders->fetch_assoc();
        					 ?>
        					<h5>Total Items : <?php echo $rows['qty']; ?></h5>
        					<h5>Total : <span id="totla_s"><?php echo $rows['total'];?></span> TZS</h5>
        					<h5>Discount : <input type="text" id="discount" name="discount" value="0" class="inputMd">
</h5>
                            
                               

        					
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
        <label>Amount</label>

        <input type="text" name="amount" class="form-control" placeholder="Enter Amount" id="th_amount" required>
        <br>
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
        					<!-- Add order to the table-->
        					<button data-toggle="modal" data-target="#orderTable" class="btn btn-small btn-warning" > + Add Order to Table</button>
        					<!-- pay button -->
        					<button data-toggle="modal" data-target="#pay" class="btn btn-small btn-info" onclick = "fun()">Pay by Cash</button>
        					<!-- credit button -->
                             <button data-toggle="modal" data-target="#credit" class="btn btn-small btn-dark float-right" >Pay by Credit</button>
    <!-- Credit div start here-->
    <form method="POST" action="">  
                            <?php 
        $issbyme = $_SESSION['USERNAME'];
        $selectOrders = $mysqli->query("SELECT SUM(orders_qty) AS qty,SUM(orders_total) AS total FROM orders WHERE issued_by = '$issbyme'") or die("ERROR 5000");
                                 $rows = $selectOrders->fetch_assoc();
                             ?>
    <div id="credit" class="modal fade" role="dialog">
     <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
        <h4 class="h4">Creditors</h4>
    </div>
    <div class="modal-body">
    <input type="hidden" name="orderQTY"
                                            value="<?php echo $rows['qty'];?>">
    <input type="hidden" name="orderTotal"
                                            value="<?php echo $rows['total'];?>">
                <label for="payd">Select Payment Method</label>
                <select id="payd" name="payMethod" class="form-control">
                <!-- <option value="cash">CASH</option> -->
                <option value="credit">CREDIT</option>


                </select>
                <label for="cName">Customer name or Room</label>

                <input id="cName" type="text" name="cName" class="form-control" required
                placeholder="Enter Customer name or Room Number">

                        <br>
        <!-- <input type="text" name="amount" class="form-control" placeholder="Enter Amount" required> -->
                                <br>
                                <input type="submit" class="btn btn-small btn-info" name="credit" value="Submit">
                                        </div>
                                        <div class="btn btn-default " data-dismiss="modal">
                                            <p class="float-right text-danger">&times; Close</p>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
   
        					
        				</div>
        				
        			</div>
        </form>
<!-- Add order to the tabe div start here -->

<form method="POST" action="">  
                            <?php 
        // $selectOrders = $mysqli->query("SELECT SUM(orders_qty) AS qty,SUM(orders_total) AS total FROM orders") or die("ERROR 5000");
        //                          $rows = $selectOrders->fetch_assoc();
                             ?>
    <div id="orderTable" class="modal fade" role="dialog">
     <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header">
        <h4 class="h4">+ Add this Order to the Table</h4>
    </div>
    <div class="modal-body">
   
                <label for="table">Select Table</label>
				<!-- select all tables from Rest -->
                <select id="table" name="table" class="form-control">
                <!-- Select * form tables where is not deleted -->
                <?php
    $table = $mysqli->query("SELECT * FROM tables WHERE table_deleted = 0") or die("Error");
                
    while($tData = $table->fetch_assoc()):
                ?>
                
                <option value="<?php echo $tData['table_id'];?>"><?php echo 'Table '.$tData['table_number']?></option>

<?php
endwhile;
?>
                </select>
                <label for="hName">Holder Name</label>

                <input id="hName" type="text" name="hName" class="form-control" required
                placeholder="Enter Waiter/Witress Name">

                        <br>
        <!-- <input type="text" name="amount" class="form-control" placeholder="Enter Amount" required> -->
                                <br>
                                <input type="submit" class="btn btn-small btn-info" name="addtoTable" value="Add Order">
                                        </div>
                                        <div class="btn btn-default " data-dismiss="modal">
                                            <p class="float-right text-danger">&times; Close</p>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
   
        					
        				</div>
        				
        			</div>
        </form>

<!-- end of order to the table -->
        			<?php 
        		}
                // echo time();

        			 ?>
        		</div>
        		<div class="col-md-1 bg-white">
        			<!-- right -->
        		</div>
        	</div>
        </div>
   
  <?php
        echo $_SESSION['change'];
      include "includes/footer.php";
        }else{
       $message = "Access Denied!";
       header("location: login.php?success=$message");
       exit();
 }
 // end of session check
?>