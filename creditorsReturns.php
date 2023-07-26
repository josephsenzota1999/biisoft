<?php 
session_start();

include "includes/start.php";
// other code goes here
if (isset($_POST['submitReturns'])) {
	# code...
	// $dept = $mysqli->escape_string($_POST['dept1']);
	$id = $mysqli->escape_string($_POST['id']);
	// echo $id;
	$return = $mysqli->escape_string($_POST['return']);
	// echo $dept;
	echo $return;
	// Calculate the amouunt to be paid by taking amounttobepaid - returns
	$refNum2 = $mysqli->query("SELECT dept_to_pay,creditors_returns FROM creditors WHERE creditors_id = $id") or die("ERROR 5000");
$refNumResults = $refNum2->fetch_assoc();
echo "<br>";	
$debtAmount1 =  $refNumResults['dept_to_pay'] - $refNumResults['creditors_returns'];
	//check amount entered if its equal to debt if not 
 //if amount enterd is == to debtamount change creditors_status to 1 
if ($debtAmount1 == $return || $return >= $debtAmount1) {
	# code...
	// echo "you complete the dets";
	// update creditors status and creditors retuns
	$mysqli->query("UPDATE creditors SET creditors_returns = creditors_returns+$return, creditors_status = 1 WHERE creditors_id = $id") or die("ERROR 5000");
	header("location: creditors.php?msg= Debt is  completed successfully");
 	exit();
}else{
	$stillDets = $debtAmount1-$return;
	$stillDetsText = "The remaining amount is {$stillDets}";

	$mysqli->query("UPDATE creditors SET creditors_returns = creditors_returns+$return WHERE creditors_id = $id") or die("ERROR 5000");
	header("location: creditors.php?msg=$stillDetsText");
 	exit();
}
}
if ($_SESSION['ROLE'] == 1 || $_SESSION['ROLE'] == 2) {
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
	<title>Biisoft F&B</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				<!-- left -->
			</div>
			<div class="col-md-8 ">
				<p>&nbsp;</p>
				<div class="card">
			
				<div>
				<a href="creditors.php" class="btn btn-small btn-dark"> <- Back to Creditors page</a>
				<p>&nbsp;</p>
					<center><h3>Add Returns to <?php 
$idd = $_GET['id'] ?? NULL;
$refNum = $mysqli->query("SELECT refNumber,dept_to_pay,creditors_returns FROM creditors WHERE creditors_id = $idd") or die("ERROR 5000");
echo "<u>".$refNum->fetch_assoc()['refNumber']."</u>";				
				?></h3></center>
			</div>
					<form method="POST" action="">
	<?php
	$refNum2 = $mysqli->query("SELECT dept_to_pay,creditors_returns FROM creditors WHERE creditors_id = $idd") or die("ERROR 5000");
$refNumResults = $refNum2->fetch_assoc();
	?>
	<input type="hidden" name="id" value="<?php echo $idd?>">
						<label>Debt</label>
	<input type="text" name="dept1" value="<?php echo $refNumResults['dept_to_pay'] - $refNumResults['creditors_returns']." TZs"; ?>" class="form-control " disabled>
						<br>
						<label for="Returns">Returns Amount</label>
						<input id="Returns" type="number" name="return" value="" class="form-control" required
						placeholder="Enter the amount">
						<br>
						<input type="submit" name="submitReturns" value="Submit Returns" class="btn btn-info">

					</form>
				</div>
			</div>
			<div class="col-md-2">
				<!-- right -->
			</div>
		</div>
	</div>
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