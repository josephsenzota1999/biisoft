<?php
session_start();
include "includes/start.php";
// other code goes here
$id = $_GET['id'];
if (isset($_POST['submit'])) {
	$instore = $_POST['instore'];
	$dates = $_POST['dates'];

	$leo = mysqli_query($mysqli, "SELECT * FROM store where store_id = '$id'");
		$ro = mysqli_fetch_assoc($leo);
		$jana = $ro['instore'];

		$total = $instore + $jana;
	if (empty($instore)) {
		array_push($errors, 'field required');
	}else{
		

		$query = mysqli_query($mysqli, "UPDATE store SET instore = '$total', quantity_updated = '$instore' WHERE store_id = '$id'");
		header('location:store.php');
	}
	# code...
}
include "includes/header.php";
?>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8"> 
			<h3>Purchase More Drinks </h3>
			<div class="form">
				<?php 

$quey = mysqli_query($mysqli, "SELECT * FROM store where store_id = '$id'");
$rows = mysqli_fetch_assoc($quey);
				 ?>
				<form method="POST">
					<div class="form-group">
						<label for='product_name'>Product Name</label>
						<input type="text" name="name" class="form-control "  value="<?php echo $rows['product_name'] ?>" disabled>
					</div>
					<!-- <div class="form-group">
												<label for='product_name'>Category</label>

					</div>
					 -->
					<div class="form-group">
												<label for='product_name'>Available Products</label>

						<input type="text" name="ins" class="form-control"  value="<?php echo $rows['instore'] ?>" disabled>
					</div>
					<div class="form-group">
												<label for='product_name'>New Products</label>

						<input type="text" name="instore" class="form-control"  value="0">
					</div>

				

						<div class="form-group">
						<input type="submit" name="submit" class="btn btn-primary"  value="Purchase Drink">
					</div>
				</form>

			</div>
		 </div>
	</div>
</div>