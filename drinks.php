<?php 
session_start();
include "includes/start.php";
// other code goes here
        
// include header here
include "includes/header.php";
if ($_SESSION['ROLE'] == 1 || $_SESSION['ROLE'] == 2) {
    # code...
?>
<div class="container">
<div id="category" class="row">

<!-- table div  responsive -->
<div class="col-md-1">

</div>
            <!-- middle -->
<div class="col-md-6">
   
<h4 class="h4 float-left">Drinks Panel</h4>
    <br>

<ul class="ul">
    <br>
    <!-- <br> -->
     <li><a href="purchase.php" class="btn btn-small btn-info">Purchase</a></li>
   <br>
   <li><a href="addDrink.php" class="btn btn-small btn-info">Drinks List</a></li>
   <br>
  
   <li><a href="store.php" class="btn btn-small btn-info">Drinks Store</a></li>

   
</ul>
           
</div>
<div class="col-md-4">
<!-- right -->
    <br>
    <br>
    <br>
    
  
   <div class=" bg-info text-white" style="padding: 50px;position: relative;top: -50px">   <center><p>Drinks Gross Profit</p></center>
    <center>
      <p>
        <h1 class="h1">
<?php
    // SELECT SUM OF PROFIT FORM SALES
    $selectSUMprofit = $mysqli->query("SELECT SUM(sales_totalNProfit) AS sProfit 
        FROM sales") or die("ERROR 5000");
$pcProfit = $selectSUMprofit->fetch_assoc();

// echo $pcProfit['qProfit'];
$sProfit = $pcProfit['sProfit'];
echo $sProfit." TZs";
    ?>
    </h1>
  </p>
  </center> </div>

<br /><br />

   <div class="mt-1 bg-warning text-white" style="position: relative;top: -50px;padding: 50px">   <center><p>Drinks Cost</p></center>
    <center>
      <p>
        <h1 class="h1">
<?php
    // SELECT SUM OF PROFIT FORM SALES
    $selectSUMprofit = $mysqli->query(" SELECT SUM(purchases_buy_price) AS total from purchases")  or die("ERROR 5000");
$pcProfit = $selectSUMprofit->fetch_assoc();

// echo $pcProfit['qProfit'];
$sProfit = $pcProfit['total'];
echo $sProfit." TZs";
    ?>
    </h1>
  </p>
  </center> </div>

</div>
<div class="col-md-1">

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