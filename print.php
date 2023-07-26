<?php 
session_start();

include "includes/start.php";
// other code goes here
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
				<a href="pos.php" class="btn btn-dark">Back to POS</a><button class="btn btn-info float-right" onClick=" printdiv('pintContent');">PRINT</button>
				<!-- content start here -->
				<p>&nbsp;</p>

				<div id="pintContent" class="card padding">
	<table>
		
					<center>
						<!-- <p>&nbsp;</p> -->
				<tr>
						<td><center>
						<img src="images/logo.png" width="230" height="220">
							
						</center>
						</td>
			</tr>
			<tr>
				<td><h1><tt><center><strong>Your Business Name</strong></center></tt></h1></td>
			</tr>
			<tr>
					<td><h2><tt><center>PHYSICAL ADDRESS: ******</center>

</tt></h2></td>
</tr>
<tr>
					<td><h2><tt><center>MAILING ADDRESS: **********</center>

</tt></h2></td>
</tr>
<tr>
					<td><h2><tt><center>TELEPHONE: *********</center>

</tt></h2></td>
</tr>
<tr>
					<td><h2><tt><center>EMAIL: ***********</center></tt></h2></td>

</tr>
					</center>
	</table>

<hr>
<?php 
if (isset($_GET['ready'])) {
	# code...
	$id = $_GET['ready'] ?? NULL;
             // echo $id;
                    if (!is_numeric($id)) {
                        # code...
        echo "<script> alert('ERROR 5000')</script>";
        exit();

                    }else{
                        // check the length of the id
                        if ($id >1000000) {
                            # code...
        echo "<script> alert('ERROR 5000')</script>";
exit();
                        }else{
$selectSales = $mysqli->query("SELECT * FROM sales WHERE sales_id = $id") or die("ERROR 5000");
$data = $selectSales->fetch_assoc();

                        }
             }
}
 ?>
 <table>
 	<tr>
 	<td>
<h1><tt>INVOICE#: <?php echo $data['sales_refNumber']; ?>
</tt>
</h1>
<h1><tt>ISSUED BY: <?php echo $data['sales_isssed_by']; ?>
</tt>
</h1>
 </td>
 <td>
 	<h2>
 		<tt>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date: <?php 
$date = strtotime($data['sales_date']);
$time = $data['sales_time'];
echo date('M d Y',$date);
echo '&nbsp;&nbsp;&nbsp;';
echo date('H:s:i A',$time);
 ?>
 </tt>

 </h2>
 </td>
 </tr>
 </table>
<hr>
<!-- Sold items list -->
<h1><tt>Items list</tt></h1>
<ul>
	<?php 
		$soldItems = $mysqli->query("SELECT * FROM salesDetails WHERE salesDetails_saledID = $id") or die("ERROR 500");
		// echo $id;
		while($rows = $soldItems->fetch_assoc()):
	 ?>
	<h1><li><tt><strong><?php echo $rows['salesDetails_name']; ?>  &nbsp;&nbsp;&nbsp;[<?php echo $rows['salesDetails_qty']; ?>]		&nbsp;&nbsp;<?php echo $rows['salesDetails_price']." TZs"; ?></strong>
</tt></li></h1>

	
<?php 
	endwhile;
 ?>
</ul>
<?php 
  $selectOrders = $mysqli->query("SELECT SUM(sales_total) AS total,SUM(sales_paid) AS paid, SUM(sales_discount) AS discout FROM sales WHERE sales_id = $id") or die("ERROR 5000");
        						 $row = $selectOrders->fetch_assoc();
 ?>
 <table>
 	<tr>
 		<td>
 <b><tt><h1>Total : <?php echo $row['total']." TZs"; ?> </h1></tt></b>
 		</td>
 </tr>
 <tr>
 		<td>
<b><tt><h1>Discount : <?php echo $row['discout']." TZs"; ?></h1> </tt></b>

 		</td>
 		</tr>
 		<tr>
 		<td>
<b><tt><h1>
	 <?php 
	 // select payment method 
	 $selectPayMethod = $mysqli->query("SELECT sales_paymentMethod FROM `sales` 
	 	WHERE sales_id = $id") or die("ERROR 5000");
	 $pMethod = $selectPayMethod->fetch_assoc()['sales_paymentMethod'];
	 // echo $pMethod;
	 if ($pMethod === 'credit') {
	 	# code...
	 	echo "Total Debt :   ";
	 echo $row['paid']." TZs";
	 }else{
	 	echo "Total Paid :   ";
	 echo $row['paid']." TZs";
	 }
 ?></h1></tt></b>
 		</td>
 	</tr>
 	<tr>
 		<!-- <td>&nbsp;</td> -->
 	</tr>
 </table>

<!-- <b>Discount : </b> -->
<center><p><b><tt><h3>Thank you for your business, welcome again!</h3></tt></b></p></center>
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