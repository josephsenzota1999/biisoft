<?php 
session_start();

include "includes/start.php";
// other code goes here
if (isset($_POST['addTable'])) {
    # code...
    $tableNumber = $mysqli->escape_string($_POST['tnumber']);
    // check if its a number and its creter than 0
    if (!is_numeric($tableNumber)) {
        # code...
        echo "<script> alert('Wrong input!'); </script>";
    }else {
        # code...
        if ($tableNumber <= 0) {
            # code...
            echo "<script> alert('Must be greter than 0!'); </script>";
        }else {
            // check if the table number exist in the database
            $tables = $mysqli->query("SELECT * FROM tables WHERE table_number = '$tableNumber'") or die('Error');
            $tableCount = mysqli_num_rows($tables);
            // echo $tableCount;
            if ($tableCount > 0) {
                # code...
                echo "<script> alert('This table number already exist!'); </script>";

            }else {
                // insert into table
                $mysqli->query("INSERT INTO tables(table_number) VALUES('$tableNumber')") or die(mysqli_error($mysqli));
                echo "<script> alert('Table Added Successfully!'); window.location.assign('tables.php'); </script>";

            }
        }
    }
}

// include header here
include "includes/header.php";
if ($_SESSION['ROLE'] == 1 || $_SESSION['ROLE'] == 3) {
    # code...
?>
<div class="container">
    
    <?php
    
    if ($_SESSION['ROLE'] == 1){
    ?>
    <button type="button" class="btn btn-small btn-info float-right" data-toggle="modal" data-target="#table">+ ADD TABLE</button>
   <?php
    }else{

    }
    ?>
<a href="kot.php" class="btn btn-small btn-white float-right">|&nbsp; KITCHEN ORDER TICKETS</a>
    <a href="bot.php" class="btn btn-small btn-white float-right"> &nbsp; BAR ORDER TICKETS</a>
 <!-- modal to add table -->
 <div class="modal fade" id="table" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- <button class="close" data-dismiss="modal">x</button> -->
                            <h4 class="float-left">+ Add new Table</h4>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                <label for="tnumber">Table Number:</label>
                            <input type="number" name="tnumber" id="tnumber" class="form-control" required placeholder="eg. 1">
                            
                            
                            <br>
                            <input class="btn btn-small btn-info btn-block" name="addTable" type="submit" value="+ Add Table">
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

    </div>
<br>
       <div class="container">

       	<h2 class="h4">Table List</h2>

<div class="row">
	<div class="col-md-8 card">

    <!-- table with no borders -->
    <table border=0>
        
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        
        <?php
    $table = $mysqli->query("SELECT * FROM tables WHERE table_deleted = 0") or die("Error");
    

    while($tData = $table->fetch_assoc()):
        $tableID = $tData['table_id'];

                ?>
        <tr >
            <?php
            // if status is openned show yellow
            if ($tData['table_status'] == 1) {
                # code...
$tableItems = $mysqli->query("SELECT COUNT(tableitems.item_name) AS totalItems FROM tables,tableitems WHERE tables.table_id = tableitems.tables_ID AND tableitems.tables_ID = '$tableID' AND item_dlt = 0;") or die("Error");
$tableItemsTotal = $tableItems->fetch_assoc();

                ?>
            <td><a href="table.orders.php?table=<?php echo $tData['table_id']?>" class='btn btn-warning' style='width:400px; padding:10px;'><span class='h4'> <sup><?php echo $tableItemsTotal['totalItems']; ?></sup> </span><img src="images/tables.png" width="60" height="50"><h1><?php echo 'TABLE '.$tData['table_number'];?></h1> </a></td>
            <?php
            }else{
                ?>
                <td><a href="table.orders.php?table=<?php echo $tData['table_id']?>" class='btn btn-success' style='width:400px; padding:10px;'><img src="images/tables.png" width="60" height="50"><h1><?php echo 'TABLE '.$tData['table_number']?></h1></a></td>

           <?php }
            ?>
        </tr>
    
        <?php
endwhile;
?>
    </table>

<?php



?>

	</div>
	
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