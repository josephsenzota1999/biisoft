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
				<center><h3>List of sold Items</h3></center>
				<div>
					<?php
					if ($_SESSION['ROLE'] == 1 || $_SESSION['ROLE'] == 2) {
						?>
				<a href="sales.php" class="btn btn-small btn-dark"> <- Back to sales</a>
				<?php
					}else {
						# code...
						?>
			<a href="sales.casher.php" class="btn btn-small btn-dark"> <- Back to My Sales</a>
					<?php
					}
					?>
				<p>&nbsp;</p>
			</div>
					<table class="table table-hover table-striple">
						<tr>
							<th>Name</th>
							<th>Category</th>
							<th>QTY</th>
							<th>Price @ 1</th>
							<th>Total Price</th>



						</tr>
						<?php 
						if (isset($_GET['items'])) {
	# code...
	$id = $_GET['items'] ?? NULL;
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
$soldItems = $mysqli->query("SELECT * FROM salesDetails WHERE salesDetails_dlt = 0 && salesDetails_saledID = $id;") or die("ERROR 5000"); 
while($data = $soldItems->fetch_assoc()):

						 ?>
						<tr>
							<td><?php echo $data['salesDetails_name']; ?></td>
							<td><?php echo $data['salesDetails_cat']; ?></td>
							<td><?php echo $data['salesDetails_qty']; ?></td>
							<td><?php echo $data['salesDetails_price']; ?></td>
							<td><?php echo $data['salesDetails_total']; ?></td>


						</tr>
<?php 
	endwhile;
}
}
}
 ?>
					</table>
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