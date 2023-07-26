<?php 
session_start();

include "includes/start.php";
// other code goes here
// add purchase and update the price and qty on the product page
if (isset($_POST['addPurchase'])) {
   $pname = $mysqli->escape_string($_POST['pname']);
   $qty =  $mysqli->escape_string($_POST['qty']);
   $bprice =  $mysqli->escape_string($_POST['bprice']);
   $sprice =  $mysqli->escape_string($_POST['sprice']);
   $time = time();
   #date format 2019-12-02
   $date = date('Y-m-d',$time);
   $purchaseby = $_SESSION['USERNAME'];
   // GET THE CURRENT QTY ON THE PRODUCT PAGE WHERE PRODUCT NAME IS = $pname
   $getQty = $mysqli->query("SELECT SUM(products_qty) AS qty FROM products WHERE products_name = '$pname'") or die("ERROR 5000");
   $getQtyData = $getQty->fetch_assoc();
   $newQty = $getQtyData['qty'];
   
   // echo $qty;
   $newQtyPlus = $qty+$newQty;
   // echo "<br>";
   // echo $newQtyPlus;

   // echo $date;
   // echo $cname.$status;
   // check if there is empty value then display error
   if (empty($pname) || empty($qty) || empty($bprice) || empty($sprice)) {
       # code...
        echo "<script> alert('All field are required!')</script>";
   }else{
        if ($qty <= 0 || $bprice <= 0 || $sprice <= 0 ) {
            # code...
        echo "<script> alert('Negative values are not allowed!')</script>";
        // header("location: cat.php?ee=ee");

        }else{
            // FIND THE NET PROFIT
        // 1 find the total after sell by taking qty * selling price @ pc

    $totalAfterSell = $qty * $sprice;
    // echo $qty." QTY";
    // echo "<br>";
    // echo $sprice." Selling price at pc";

    // echo "<br>";
    // echo $bprice." Buying price at pc";

    // echo "<br>";
    // echo $totalAfterSell." Total after sale";
    // echo "<br>";
    // Find profit Afer sell
    $profitAfterSell = $totalAfterSell - $bprice*$qty;
    // echo $profitAfterSell." Total Profit";
    // find proft @ one product
    // 1 take buying price / qty to get the buying price @ pc
    $buyingPricePc = $sprice - $bprice;
    // echo "<br>";

    // echo $buyingPricePc." At pc";

    // echo "<br>";
 $pcProfit =  $sprice - $bprice;
 // echo $pcProfit;

    //         // insert into the database 
    $sql = "INSERT INTO purchases(purchases_name,purchases_qty,purchases_buy_price,purchases_sell_price,purchased_by,purchases_date,purchases_time,purchases_totalAfterSell,purchases_profitAfterSell,purchases_buyingPricePc) VALUES('$pname','$qty','$bprice','$sprice','$purchaseby','$date','$time',
    '$totalAfterSell','$profitAfterSell','$bprice')";
    // then update the product qty and price where the product name is equal to $pname;
    $sql1 = "UPDATE products SET products_qty = '$newQtyPlus', products_price = '$sprice' ,products_profitPerPc = '$pcProfit' WHERE products_name = '$pname'";
    $sql2 = "UPDATE store SET instore = '$newQtyPlus' WHERE product_name = '$pname'";

        if ($mysqli->query($sql) === TRUE) {
         # code...
        $mysqli->query($sql1);
        $mysqli->query($sql2);

        echo "<script> alert('Purchase is Added!');window.location.assign('purchase.php');</script>";

        // exit();

     }else{
        echo mysqli_error($mysqli);
     }

        }
        
   }


}

// UPDATE THE PURCHASES TABLE
if (isset($_POST['purUpdate'])) {
    $id = $mysqli->escape_string($_POST['id']);
   $pname = $mysqli->escape_string($_POST['pname']);
   $qty =  $mysqli->escape_string($_POST['qty']);
   $bprice =  $mysqli->escape_string($_POST['bprice']);
   $sprice =  $mysqli->escape_string($_POST['sprice']);
   $time = time();
   #date format 2019-12-02
   $date = date('Y-m-d',$time);
   // $purchaseby = 'unkown';
   $purchaseby = $_SESSION['USERNAME'];


   // GET THE CURRENT QTY ON THE PRODUCT PAGE WHERE PRODUCT NAME IS = $pname
   $getQty = $mysqli->query("SELECT SUM(products_qty) AS qty FROM products WHERE products_name = '$pname'") or die("ERROR 5000");
   $getQtyData = $getQty->fetch_assoc();
   $newQty = $getQtyData['qty'];
    

    $totalAfterSell = $qty * $sprice;

    $profitAfterSell = $totalAfterSell - $bprice*$qty;

    $buyingPricePc = $sprice - $bprice;

    $pcProfit =  $sprice - $bprice;

   // echo $id;
   // echo "<br>";
   
   // echo $qty." Entered by user";
   // $newQtyPlus = $newQty -$qty;
   // $newQtyPlus = $qty + $newQty;


   // echo $newQtyPlus." Plus new qty";
//    echo "<br>";
// echo $newQty." From database";
//    echo "<br>";

// CALC FOR QTY ON DATABASE FROM PRODUCTS AND QTY THAT IS UPDATED 
// FIRST SELECT THE CURRENT QTY FROM PURCHASE WHERE ID = $id THEN COMPARE 
$currentQTYSelect = $mysqli->query("SELECT SUM(purchases_qty) AS qty FROM purchases WHERE purchases_id = $id") or die("ERROR 5000");
$currentQTY = $currentQTYSelect->fetch_assoc()['qty'];
// echo $currentQTY." Current on ID";
   // echo "<br>";
$qtyAll = $qty-$currentQTY;
// echo $qtyAll."   QTY - QTY ON THE DATABASE";

   // echo "<br>";

$finalQTY = $newQty+$qtyAll;
// echo $finalQTY." Final Output!";


   // echo $date;
   // echo $cname.$status;
   // echo $id;
   // check if there is empty value then display error
   if (empty($pname) || empty($qty) || empty($bprice) || empty($sprice)) {
       # code...
        echo "<script> alert('All field are required!')</script>";
        // exit();
   }else{
    // what if some hacker mess with id on hidden input?
     // insert into the database 
    $sql = "UPDATE purchases SET purchases_name = '$pname',purchases_qty = '$qty',purchases_buy_price = '$bprice', purchases_sell_price = '$sprice',
        purchased_by = '$purchaseby', purchases_date = '$date',purchases_time = '$time' 
        ,purchases_totalAfterSell = '$totalAfterSell',
purchases_profitAfterSell = '$profitAfterSell',
purchases_buyingPricePc = '$bprice' WHERE purchases_id = $id";
    // then update the product qty and price where the product name is equal to $pname;
    $sql1 ="UPDATE products SET products_qty = '$finalQTY', products_price = '$sprice',
    products_profitPerPc = '$pcProfit' WHERE products_name = '$pname'";

    $sql2 = "UPDATE store SET instore = '$finalQTY' WHERE product_name = '$pname'";

        
// 

if ($mysqli->query($sql) === TRUE) {
         # code...
        $mysqli->query($sql1);
        $mysqli->query($sql2);
header("location: purchase.php?msg= Purchase is Updated!");
        exit();

     }else{
        echo mysqli_error($mysqli);
     }

}
}
// DELETE THE PURCHASE 
if (isset($_GET['delete'])) {
                    # code...
                    $id = $_GET['delete'] ?? NULL;
                    $dltTime = time();
                    $dltBy = $_SESSION['USERNAME'];
   // $purchaseby = $_SESSION['USERNAME'];

                    // echo $id;
                    // check if the $id is number
                    if (!is_numeric($id)) {
                        # code...
        echo "<script> alert('ERROR 5000')</script>";

                    }else{
                        // check the length of the id
                        if ($id >1000000) {
                            # code...
        echo "<script> alert('ERROR 5000')</script>";

                        }else{
    $selectProductname =  $mysqli->query("SELECT purchases_name,purchases_sell_price FROM purchases WHERE purchases_id = $id");
    $data = $selectProductname->fetch_assoc();
    $productName = $data['purchases_name'];
    $productPrice = $data['purchases_sell_price'];

    // CALCULATION ON DELETE THE PURCHASE WITHOUT MESS WITH THE QTY AND RPICE
    $getQty = $mysqli->query("SELECT SUM(products_qty) AS qty FROM products WHERE products_name = '$productName'") or die("ERROR 5000");
   $getQtyData = $getQty->fetch_assoc();
   $productQTY = $getQtyData['qty'];
$currentQTYSelect = $mysqli->query("SELECT SUM(purchases_qty) AS qty FROM purchases WHERE purchases_id = $id") or die("ERROR 5000");
$currentQTY = $currentQTYSelect->fetch_assoc()['qty'];
// take product qty - purcahse qty the update the product qty
        $finalQty = $productQTY-$currentQTY;
        // $finalQty = $currentQTY - $productQTY;

        // echo $finalQty;
        // echo $productPrice;

        $sql = "UPDATE purchases SET purchases_deleted = 1,purchases_dlt_date = '$dltTime',purchases_dlt_by = '$dltBy' WHERE purchases_id = $id";
        $sql1 = "UPDATE products SET products_qty = $finalQty, products_price = $productPrice WHERE products_name = '$productName'";
         $sql2 = "UPDATE store SET instore = '$finalQty' WHERE product_name = '$productName'";

        
// 

if ($mysqli->query($sql) === TRUE) {
         # code...
        $mysqli->query($sql1);
        $mysqli->query($sql2);
header("location: purchase.php?msgd= Purchase is Deleted!");
exit();

     }else{
        echo mysqli_error($mysqli);
     }

        }
    }
}
        
// include header here
include "includes/header.php";
if ($_SESSION['ROLE'] == 1 || $_SESSION['ROLE'] == 2) {
    # code...

?>

<?php
// SELECT THE PRUDUCTS
                if (isset($_GET['edit'])) {
                    # code...
                    $id = $_GET['edit'] ?? NULL;
                    // echo $id;
                    // check if the $id is number
                    if (!is_numeric($id)) {
                        # code...
        echo "<script> alert('ERROR 5000')</script>";

                    }else{
                        // check the length of the id
                        if ($id >1000000) {
                            # code...
        echo "<script> alert('ERROR 5000')</script>";

                        }else{
        $purchaseSelect = $mysqli->query("SELECT * FROM purchases WHERE purchases_id = $id && purchases_deleted = 0");
       
        ?>
<div class="container">
    <div id="purUpdate" class="row">
        <div class="col-md-3">
            
        </div>
        <div class="col-md-5">
                        <center>
                            <h4>Update Purchase</h4>
                        </center>
            <form action="" method="post">
                <?php
                     $data = $purchaseSelect->fetch_assoc();
                     // echo var_dump($data);
                ?>
                <input type="hidden" name="id" value="<?php echo $data['purchases_id'];?>">
                <br>
                <label>QTY</label>
                <input type="number" name="qty" value="<?php echo $data['purchases_qty'];?>"
                required class="form-control">
                <br>
                <label>Buying Price @ pc</label>
                <input type="number" name="bprice" value="<?php echo $data['purchases_buy_price'];?>"
                required class="form-control">
                <br>
                <label>Selling price @ pc</label>
                <input type="number" name="sprice" value="<?php echo $data['purchases_sell_price'];?>"
                 required class="form-control">

                 <br>
                 <label for="cat">Update Product you purchase:</label>
                            <select name="pname" class="form-control"id="cat">
                                <option selected value="<?php echo $data['purchases_name'];?>">--<?php echo $data['purchases_name'];?>--</option>
                                <?php
        $cat = $mysqli->query("SELECT * FROM products WHERE products_deleted = 0 && products_status = 'active' ORDER BY products_name ASC");
                                 while($data = $cat->fetch_assoc()):   

                                ?>
                                <option value="<?php echo $data['products_name'];?>">
                                    <?php echo $data['products_name'];?>
                                </option>
                                <?php 
                            endwhile;
                            ?>
                            </select>
                            <br>
<input type="submit" name="purUpdate" class="btn btn-info btn-block" value="Update">

                

                </form>
</div>
        <div class="col-md-3">
            
        </div>
    </div>
</div>
                </div>
        <?php

                        }


                    }
                 
                }
            ?>


<div class="container">
<div id="purchases" class="row">

<!-- table div  responsive -->
<div class="col-md-1">

</div>
            <!-- middle -->
<div class="col-md-10">
                <center>
                    <?php 
                    if(isset($_GET['msg'])){
                    echo  "<p class='text-success'>".$_GET['msg']."</p>";
                }
                elseif (isset($_GET['msgd'])) {
                    # code...
                    echo  "<p class='text-danger'>".$_GET['msgd']."</p>";

                }
                ?>
                </center>
               <!-- <p> <center>Gross Profit if you will sell all the Drinks is <button class="btn btn-success"> -->
                <?php 
// $netProfit = $mysqli->query("SELECT SUM(purchases_profitAfterSell) AS futureProfit FROM purchases WHERE 
//     purchases_deleted = 0;") or die("ERROR 5000");

// echo $netProfit->fetch_assoc()['futureProfit']." TZs";
                 ?>
            <!-- </button></center></p> -->

                <h4 class="h4 float-left">List of Purchases</h4>



            <button type="button" class="btn btn-small btn-info float-right" data-toggle="modal" data-target="#product">+ ADD PURCHASES</button>
            <center><a href="drinks.php"> << Back to drinks panel</a></center>

                <form action="" method="POST" class="mt-5" style="position: relative;border:1px solid #cdcdcd;padding: 10px;border-radius: 3px">
            <label for="from" >FROM</label>
            <input type="date" name="from" class="" id="from"
                required placeholder="MM-DD-YYYY">
            <!-- </div><br> -->
            <label for="to" >TO</label>
            <input type="date" name="to" class="" id="to"
            required placeholder="MM-DD-YYYY">
            <!-- <br> -->
            <input type="submit" name="salesDates" value="Search" class="btn btn-info">
            <!-- </div> -->
        </form>
<?php 
            // check if the salesDates is set the show the results based on the dates
        if (isset($_POST['salesDates'])) {
            # code...
    $from = $mysqli->escape_string($_POST['from']);
    $to = $mysqli->escape_string($_POST['to']);
    // echo $from;
    // echo "<br>";
    // echo $to;
?>

        <br>
<input type="search" oninput="w3.filterHTML('#searchSales','.item', this.value)" placeholder="Search sales here" class="form-control">
<br>
<div id="printSales1">
    <h3 id="textSales1">
        
    </h3>
<table id="searchSales" class="table table-responsive">
            <thead>
                <tr>
                    <th>Purchase Name</th>
                    <th>Quantity</th>
                    <th>Buying Price</th>
                    <th>Selling Price</th>
                    <th>Profit After Sell</th>
                    <th>Total After Sell</th>
 <th>Issued By</th>                 
    <th>Date</th>
                   
                    <th>
<button class="btn btn-dark" onClick="salesText(), printdiv('printSales1');">PRINT</button>

                    </th>

<th></th>
<th></th>
                </tr>

            </thead>
            <tbody>
                <?php 
                
                    $selectSales = $mysqli->query("SELECT * FROM purchases WHERE purchases_deleted = 0 && purchases.purchases_date BETWEEN '$from' AND '$to' ORDER BY purchases_id DESC;
") or die("ERROR 5000");
                    while($data = $selectSales->fetch_assoc()):
                 ?>
                <tr class="item">
                    
                    <td><?php echo $data['purchases_name'];?></td>
                    <td><?php echo $data['purchases_qty'];?></td>
                    <td><?php echo $data['purchases_buy_price']." TZs";?></td>
                    <td><?php echo $data['purchases_sell_price']." TZs";?></td>
                    <td><?php echo $data['purchases_profitAfterSell']." TZs";?></td>
                    <td><?php echo $data['purchases_totalAfterSell']." TZs";?></td>
                       <td><?php echo $data['purchased_by']." TZs";?></td>
                          <td><?php echo $data['purchases_date']." TZs";?></td>

               



                </tr>
                
                <?php 
                endwhile;
                 ?>

           <tr>
                  
        </u>
<table class="table table-striped table-hover" style="background: #17a2b8; position: relative;left:1px;color: white;width: 750px">
        <thead>
                        <th>Product Name</th>

            <th>Product Quantity</th>
            <th>Product Instore</th>
            <th>Product Sold</th>
                        <th>Product Remained</th>

            <!-- <th>Profit After Sell</th> -->
            <th>From</th>
            <th>To</th>

        </thead>
        <tbody>

                                <?php

                                $selecte = mysqli_query($mysqli,"SELECT purchases.purchases_name,    purchases.purchases_name, store.product_name, SUM(purchases.purchases_qty) AS QTY, SUM(purchases.purchases_totalAfterSell) AS total, SUM(store.sold) AS sold, SUM(store.instore) AS instore, (store.instore - store.sold) As sale FROM purchases JOIN store ON purchases.purchases_name = store.product_name WHERE purchases.purchases_date >= '2023-06-01' AND purchases.purchases_date <= '2023-06-02' GROUP BY purchases.purchases_name, store.product_name ");
if (mysqli_num_rows($selecte)>0) {
    while ($rows = mysqli_fetch_assoc($selecte)) {
        ?>
            <tr>
                <td><?php echo $rows['purchases_name'];  ?></td>

                <td><?php echo $rows['QTY'];  ?></td>
                <td><?php echo $rows['instore'];  ?></td>
                <td><?php echo $rows['sold'];  ?></td>
                               <td><?php echo $rows['sale'];  ?></td>

        
                <td><?php echo $from  ?></td>
                                <td><?php echo $to  ?></td>




            </tr>
                  <?php
    }
}
?>

        </tbody>
    </table>
  

                          </tr>

</tbody>
</table>


<?php 
}else{
?>












































            <!-- modal of cat -->
            <div class="modal fade" id="product" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- <button class="close" data-dismiss="modal">x</button> -->
                            <h4 class="float-left">+ Add Purchases</h4>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                
                            <label for="cat">Select Drinks you purchase:</label>
                            <select name="pname" class="form-control"id="cat">
                                <!-- <option selected="True">--select here--</option> -->
                                <?php
        $cat = $mysqli->query("SELECT * FROM products WHERE products_deleted = 0 && products_status = 'active' ORDER BY products_name ASC");
                                 while($data = $cat->fetch_assoc()):   

                                ?>
                                <option value="<?php echo $data['products_name'];?>">
                                    <?php echo $data['products_name'];?>
                                </option>
                                <?php 
                            endwhile;
                            ?>
                            </select>
                            <!-- <br> -->
                            <label for="qty">QTY</label>
                            <input type="number" class="form-control" name="qty" id="qty" required
                            >
                            <label for="bprice">Buying Price @ pc</label>
                            <input type="number" class="form-control" name="bprice" id="bprice" required>
                            <label for="sprice">Selling Price @ pc</label>
                            <input type="number" class="form-control" name="sprice" id="sprice" required>
                            <br>
                            <input class="btn btn-small btn-info btn-block" name="addPurchase" type="submit" value="+ Add">
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <input type="search" class="form-control mt-5" placeholder="Search Drink here..."
                oninput="w3.filterHTML('#searchTable','.item',this.value)">
                <br>
                <div id="purchasesPrint">
                    <center> <h4 id="titleHeading"></h4></center>
            <table id="searchTable" class="table table-stripe table-responsive table-hover">
                <tr>
                    <th>Drinks  Name</th>
                    <th>QTY</th>
                    <th>Buying Price</th>
                    <th>Selling Price</th>
                    <th>Issued by </th>
                    <th>date </th>
                    <th> <button class="btn btn-small btn-dark" 
                        onClick="purchasesText(), printdiv('purchasesPrint');">Print</button></th>
                    <th>&nbsp;</th>



                </tr>
                <?php 
        $purchase = $mysqli->query("SELECT * FROM purchases WHERE purchases_deleted = 0 ORDER BY purchases_id DESC");
        // $data = $cat->fetch_assoc();
        $purchaseCount = mysqli_num_rows($purchase);

        // echo $data['categories_deleted'];
        if ($purchaseCount == 0) {
            # code...
            echo "<tr><td>There is no data to display!</td></tr>";

        }else{
            while($rows = $purchase->fetch_assoc()):
            ?>
            <tr class="item">
                    <td><?php echo $rows['purchases_name']; ?></td>
                    <td><?php 
                        if ($rows['purchases_qty'] <= 5) {
                            # code...
                            echo "<p class='text-danger'>".$rows['purchases_qty']."</p>";
                        }elseif ($rows['purchases_qty'] <= 10) {
                            # code...
                             echo "<p class='text-warning'>".$rows['purchases_qty']."</p>";
                        }else{
                            echo "<p class='text-info'>".$rows['purchases_qty']."</p>";
                        }
                     

                    ?></td>
                    <td><?php echo $rows['purchases_buy_price']." TZs"; ?></td>
                    <td><?php echo $rows['purchases_sell_price']." TZs"; ?></td>
                    <td><?php echo $rows['purchased_by']; ?></td>

                    <td><?php 
                        $time = $rows['purchases_date']; 
                        $time2 = $rows['purchases_time'];
                        $timeFormat = strtotime($time);
                        echo date('M d Y',$timeFormat);
                        // echo "<br>";
                        echo '&nbsp;&nbsp; '.date('H:i:s A',$time2);
                    ?></td>
                    <td>
                        <a href="purchase.php?edit=<?php echo $rows['purchases_id']; ?>" class="btn btn-small btn-info">[] EDIT</a>
                    </td>
                    <td>
                        <?php 
                            // check if the user is admin then show delete btn 
                        if ($_SESSION['ROLE'] == 1) {
                            # code...
                            ?>
                            <a href="purchase.php?delete=<?php echo $rows['purchases_id']; ?>" class="btn btn-small btn-danger" onclick="return confirm('Are you sure you want to delete?')">x</a>
                        <?php }else{
                            // echo "d";
                        }
                            
                         ?>
                        
                    </td>

            </tr>

            <?php 
        endwhile;
        }

                ?>
                
                
            </table>
        <?php } ?>
                </div>

        </div>
</div>
<!-- <div class="col-md-1 bg-danger">
left
</div> -->
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