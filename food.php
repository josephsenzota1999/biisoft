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
   
<h4 class="h4 float-left">Food Panel</h4>
    <br>

<ul class="ul">
    <br>
    <!-- <br> -->
   <li><a href="addFood.php" class="btn btn-small btn-info">Food Menu</a></li>
   <br>
   
   
</ul>
           
</div>
<div class="col-md-4 text-white">
<!-- right -->
    <img src="images/food.jpg" title="FOOD PANEL" width="100%" alt="Logo">

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