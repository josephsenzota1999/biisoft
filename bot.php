<?php 
session_start();

include "includes/start.php";
// other code goes here


// include header here
include "includes/header.php";
if ($_SESSION['ROLE'] == 1 || $_SESSION['ROLE'] == 3) {
    # code...
?>
<div class="container">
    
   
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

       	<h2 class="h4">BAR ORDER TICKETS</h2>

<div class="row">
	<div class="col-md-8 card">

    <!-- table with no borders -->
    <table id="" class="table table-hover">
			<thead>
				<tr>
					<th>KOT number</th>
					<th>Item Name</th>
					<th>Qty</th>
                    <th>Table Number</th>
                    <th>Recorded Time</th>
					<th>
</th>


				</tr>

			</thead>
			<tbody>
				<?php 
$selectSalesCat = $mysqli->query("SELECT bot_id,bot_number,bot_datetime,item_name,item_qty,table_number FROM bot,tables WHERE tables_ID = tableS.table_id") or die("ERROR 5000");
					while($data = $selectSalesCat->fetch_assoc()):
				 ?>
				<tr>
					<td><?php echo $data['bot_number'];?></td>
					<td><?php echo $data['item_name'];?></td>
					<td><?php echo $data['item_qty'];?></td>
					<td><?php echo $data['table_number'];?></td>
					<td><?php
                    $time =  $data['bot_datetime'];
                     echo date('Y M d H:i:s A',$time);
                     
                     ?></td>
								
            <td><a href="includes/delete.bot.php?delete=<?php echo $data['bot_id']; ?>" class="btn btn-danger">X</a></td>


				</tr>
				<?php 
				endwhile;
				 ?>
			</tbody>
		</table>



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