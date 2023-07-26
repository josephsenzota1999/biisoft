<?php 
session_start();

include "includes/start.php";
// other code goes here
// GENERATE KITCHEN ORDER TICKET
if (isset($_POST['kot'])) {
	# code...
    $tableID2 = $_SESSION['TABLEID'];
    $salesBy = $_SESSION['USERNAME'];
    $time = time();
    $kotNumber = "kot".date('YmdHis',$time);


	// $order = $_POST['orders'];
	if (!empty($_POST['orders'])) {
		# code...
		// select kot
		foreach ($_POST['orders'] as $orders) {
			# code...
			// echo $orders."<br>";
			// $salesBy = $_SESSION['USERNAME'];
// select all data from tableItems where table id == $orders
$kot = $mysqli->query("SELECT * FROM tableitems  WHERE tables_ID = $tableID2 AND tableItems_id = $orders AND issued_by = '$salesBy' AND item_dlt = 0") or die(mysqli_error($mysqli));
// check if $orders existi on the on KOT TABLE as tableItems_id
$kotCheck = $mysqli->query("SELECT tableItems_id FROM kot WHERE tableItems_id = $orders") or die(mysqli_error($mysqli));
// count the results from $kotCheck
$tokCheckCount = mysqli_num_rows($kotCheck);

if ($tokCheckCount > 0) {
	# code...
	// echo "<script> alert('This order already  generated KOT!');window.location.assign('table.orders.php?table=$tableID2');</script>";

}else {
	# loop ...
// loop orders and convert them into assoc array 
while($data = $kot->fetch_assoc()):
	$pname = $data['item_name'];
	$pqty = $data['item_qty'];
	$savedBy1 = $data['item_savedby'];
	$tables_ID = $data['tables_ID'];
	$salesBy1 = $data['issued_by'];
	// insert into salesDetails table
	$mysqli->query("INSERT INTO kot(
		item_name,item_qty,kot_number,recorded_by,saved_by,kot_datetime,tables_ID,tableItems_id) 
		VALUES('$pname','$pqty','$kotNumber','$salesBy1','$savedBy1','$time',$tableID2,$orders)") or die(mysqli_error($mysqli));
endwhile;

}

}#end of foreach loop
        
	}else {
		# code...
		echo "<script> alert('Please Select what you what to generate KOT!');window.location.assign('table.orders.php?table=$tableID2');</script>";
	}
}

	// GENERATE BAR ORDER TICKET
	if (isset($_POST['bot'])) {
		$tableID2 = $_SESSION['TABLEID'];
		$salesBy = $_SESSION['USERNAME'];
		$time = time();
		$botNumber = "bot".date('YmdHis',$time);

		# code...
		// $order = $_POST['orders'];
		if (!empty($_POST['orders'])) {
			# code...
			// select kot
			foreach ($_POST['orders'] as $orders) {
				# code...
				// echo $orders."in the loop";
				// select all data from tableItems where table id == $orders
$kot = $mysqli->query("SELECT * FROM tableitems  WHERE tables_ID = $tableID2 AND tableItems_id = $orders AND issued_by = '$salesBy' AND item_dlt = 0") or die(mysqli_error($mysqli));
// check if $orders existi on the on KOT TABLE as tableItems_id
$botCheck = $mysqli->query("SELECT tableItems_id FROM bot WHERE tableItems_id = $orders") or die(mysqli_error($mysqli));
// count the results from $kotCheck
$tokCheckCount = mysqli_num_rows($botCheck);

if ($tokCheckCount > 0) {
	# code...
	echo "<script> alert('This order already  generated BOT!');window.location.assign('table.orders.php?table=$tableID2');</script>";

}else {
	# loop ...
// loop orders and convert them into assoc array 
while($data = $kot->fetch_assoc()):
	$pname = $data['item_name'];
	$pqty = $data['item_qty'];
	$savedBy = $data['item_savedby'];
	$tables_ID = $data['tables_ID'];
	// insert into salesDetails table
	$mysqli->query("INSERT INTO bot(
		item_name,item_qty,bot_number,recorded_by,saved_by,bot_datetime,tables_ID,tableItems_id) 
		VALUES('$pname','$pqty','$botNumber','$salesBy','$savedBy','$time',$tableID2,$orders)") or die(mysqli_error($mysqli));
endwhile;

}
				header("location: bot.print.php");
				exit();
			}#end of foreach loop

			
		}else {
			# code...
			echo "<script> alert('Please Select what you what to generate BOT!');window.location.assign('table.orders.php?table=$tableID2');</script>";
		}
	}
	// end of bot
// end of kot and bot

if ($_SESSION['ROLE'] == 1 || $_SESSION['ROLE'] == 2 || $_SESSION['ROLE'] == 3) {
    # code...

?>
<!DOCTYPE html>
<html>
<head>
	 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo MAIN_URL; ?>/css/main.css">
    <link rel="stylesheet" href="<?php echo MAIN_URL; ?>/css/bootstrap.min.css">
    <link rel="Shortcut Icon" href="favicon.ico">
<link rel="icon" type="image/png" href="<?php echo MAIN_URL; ?>/images/favicon.png">
	<title>Biisoft - F&B</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				<!-- left -->
			</div>
			<div class="col-md-8">
				<p>&nbsp;</p>
				<?php
						$tableID2 = $_SESSION['TABLEID'];
				?>
				<a href="table.orders.php?table=<?php echo $tableID2;?>" class="btn btn-dark">Back to Tables </a><button class="btn btn-info float-right" onClick=" printdiv('pintContent2');">PRINT</button>
				<!-- content start here -->
				<p>&nbsp;</p>

				<div id="pintContent2" class="card padding">
	<table>
		
					<center>
						<!-- <p>&nbsp;</p> -->
				<tr>
					<!-- <td>l</td> -->
						<!-- <td><tt><center>
						<img src="images/logo.png" width="230" height="220">
						</center> -->
						</tt>
						</td>
						<!-- <td>r</td> -->
			</tr>
			<tr>
				<td><h1><tt><center><strong>Your Business Name</strong></center></tt></h1></td>
			</tr>
			
<tr>
					<!-- <td><h2><tt><center>P.O.BOX 1525 Arusha, Tanzania</center> -->

</tt></h2></td>
</tr>
<tr>
					<td>
<?php
$kotNumber = $mysqli->query("SELECT kot_number FROM kot WHERE deleted = 0 AND tables_ID = '$tableID2'") or die(mysqli_error($mysqli));
	$numberKOT = $kotNumber->fetch_assoc()['kot_number'];
	?>	
					
					<h2><tt><center>KOT Number:<b> <?php echo $numberKOT; ?></b></center>

</tt></h2></td>
</tr>
					</center>
	</table>

<hr>

 <table>
 	<tr>
 	<td>
	 <?php
$kotTable = $mysqli->query("SELECT tables_ID FROM kot WHERE deleted = 0 AND tables_ID = '$tableID2'") or die(mysqli_error($mysqli));
	$tableKOT = $kotTable->fetch_assoc()['tables_ID'];
	$selectTableName = $mysqli->query("SELECT table_number FROM tables WHERE table_id = $tableKOT") or die("error select");

	?>	
<h1><tt>Table#: <?php echo $selectTableName->fetch_assoc()['table_number']; ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;TIME:
	<?php 
	$time1 = time();
	echo date('M d Y H:i:s A');
	 ?>
</tt>
</h1>
 </td>
 </tr>
 </table>
<hr>
<!-- Sold items list -->
<h1><tt>Items list</tt></h1>
<ul>
	<?php 
	
	
$soldItems = $mysqli->query("SELECT * FROM kot WHERE deleted = 0 AND tables_ID = '$tableID2'") or die(mysqli_error($mysqli));
		// echo $id;
		while($rows = $soldItems->fetch_assoc()):
		?>
	<h1><li><tt><strong><?php echo $rows['item_name']; ?>  &nbsp;&nbsp;&nbsp;[<?php echo $rows['item_qty']; ?>]		&nbsp;&nbsp;</strong></tt></li></h1>

	
<?php 
	endwhile;

 ?>
</ul>
<?php 
  $selectOrders = $mysqli->query("SELECT SUM(item_qty) AS totalQty FROM kot WHERE deleted = 0 AND tables_ID = '$tableID2'") or die("ERROR 5000");
        	$row = $selectOrders->fetch_assoc();
 ?>
 <table>
 	<tr>
 		<td>
 <b><tt><h1><strong>Total QTY: <?php echo $row['totalQty']; ?></strong> </h1></tt></b>
 		</td>
 </tr>
 
 	<tr>
 		<!-- <td>&nbsp;</td> -->
 	</tr>
 </table>

<!-- <b>Discount : </b> -->
<!-- <center> -->
	<p><b><tt><h3> Special Requirements: </h3></tt></b></p>
<br>
<textarea name="special" id="" cols="95" rows="5" disabled></textarea>
<!-- </center> -->

<!-- <center> -->
	<p><b><tt><h3> **** END OF KITCHEN ORDER TICKET ****</h3></tt></b></p>
<!-- </center> -->
<table>
	<tr>
		<th>&nbsp;</th>

	</tr>
	<tr>
		<th>&nbsp;</th>

	</tr>
	<tr>
		<th>&nbsp;</th>

	</tr>
	<tr>
		<th>&nbsp;</th>

	</tr>
	<tr>
		<th>&nbsp;</th>

	</tr>
	<tr>
		<th>&nbsp;</th>

	</tr>
</table>
				</div>
			</div>
			<div class="col-md-2">
				<!-- right -->
			</div>
		</div>
	</div>
	<script type="text/javascript">
	 // PRINTING
    function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}

</script>
<?php 
}else{
       $message = "Access Denied!";
       header("location: login.php?success=$message");
       exit();
 }
 // end of session check
 ?>
</body>
</html>