<?php 
session_start();
include "includes/start.php";
// other code goes here


// CHECK IF THE USER IS LOGIN IN THE DISPLAY THE PAGE CONTENT
// <?php 
 if ($_SESSION['ROLE'] == 1 || $_SESSION['ROLE'] == 2  || $_SESSION['ROLE'] == 3) {
 	# code...
 
	

// include header here
include "includes/header.php";
?>
    <div class="container">
      <div class="row">
        <div class="col-md-2">
          <!-- left -->
        </div>
        <div class="col-md-8">
          
      <h3 class="float-left">My Store</h3> 
      <?php
      if ($_SESSION['ROLE'] == 1 || $_SESSION['ROLE'] == 2 ){
      ?>
<a href="drinks.php" class="float-right"> << Back to drinks panel</a>
      <?php
        }else{
          // echo "sisi";
        }
      ?>
            
<p><input type="search" oninput="w3.filterHTML('#searchStore','.item',this.value)" placeholder="Search Drinks in Store" class="form-control"></p>
<div id="storePrint">
 <center> <h4 id="titleHeading"></h4></center>
<table class="table table-hover" id="searchStore">
  <thead>
   <tr>
    <th>Action</th>
      <th>Drink Name</th>
    <th>Category</th>
    <th>Drinks Total</th>
    <th>Drinks Available in store</th>
    <th>Drinks Sold</th>
       <th>Drink Cost</th>
      <th>Drink Profit</th>

     <th>Drink Updated</th>
    <th>
      <button class="btn btn-small btn-dark" onClick="printedText(),printdiv('storePrint');">Print</button>
      
    </th>
   </tr>
  </thead>
  <tbody>
    <?php 
$store = $mysqli->query(
  " SELECT store_id,quantity_updated,product_name,categories_name,purchases_buy_price - purchases_sell_price as totali,instore,updates_at,sold,instore+sold AS total FROM store,categories,purchases WHERE category = categories_id && purchases_name = product_name ORDER BY instore DESC") or die("ERROR 5000");
    while($rows = $store->fetch_assoc()):


     ?>
   <tr class="item">
    <td> <a href="ongeza.php?id=<?php echo $rows['store_id'] ?>">Purchase More</a></td>
  <td><?php echo $rows['product_name']; ?></td>
  <td><?php echo $rows['categories_name']; ?></td>
  <td><?php echo $rows['total']; ?></td>
  
 <td><?php if ($rows['instore'] <= 3 && $rows['instore'] != 0) {
                            # code...
                          $pname = $rows['product_name'];
                            echo "<p class='text-danger'>".$rows['instore']."</p>";
                      echo "<script> alert('There are lower than 3 {$pname} in store, please go to Drinks panel to add more in store')</script>";

                        }else{
                            echo "<p class='text-info'>".$rows['instore']."</p>";
                        }
                     ?></td>

  <td><?php echo $rows['sold']; ?></td>
     
  
  <td><?php echo $rows['totali']; ?></td>

  <td><?php echo $rows['updates_at']; ?></td>
 
     
  <td><?php echo $rows['quantity_updated']; ?></td>

   </tr>
   <?php 
    endwhile;

  ?>
                
  </tbody>
</table>
</div>

        </div>
        <div class="col-md-2">
          <!-- right -->
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