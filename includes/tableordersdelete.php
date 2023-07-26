<?php
session_start();
include "start.php";

// DELETE THE ORDER THEN UPDATE STORE (TAKE THE ODERDERD QTY AND RETURN IT TO THE STORE)
if (isset($_GET['delete'])) {
    # code...
    $id = $_GET['delete'] ?? NULL;
    $timeNow = time();
    $dltUser = $_SESSION['USERNAME'];
    // echo $id;
    // check if the $id is number
    if (!is_numeric($id)) {
        # code...
// echo "<script> alert('$tableGET')</script>";

    }else{
        // check the length of the id
        if ($id >100000000) {
            # code...
echo "<script> alert('ERROR 5000')</script>";

        }else{
            
// SELECT PRODUCT NAME FROM ORDER TABLE SO THAT CAN BE USED TO UPDATE THE QTY WHEN DELETING 
$selectProdctName = $mysqli->query("SELECT item_name,item_qty FROM tableItems WHERE tableItems_id = $id") or die("ERROR 5000");
$nameQty = $selectProdctName->fetch_assoc();
$productName = $nameQty['item_name'];
$productQty = $nameQty['item_qty'];

// UPDATE PRODUCT QTY
$sql = "UPDATE products SET products_qty = products_qty + $productQty  
WHERE products_name = '$productName'";
// UPDATE STORE QTY
$sql1 = "UPDATE store SET instore = instore + $productQty,sold = sold - $productQty 
WHERE product_name = '$productName'";
$sql2 = "UPDATE tableItems SET item_dlt = 1 , item_dlt_time = '$timeNow', item_dlt_by = '$dltUser' WHERE tableItems_id = $id";

if ($mysqli->query($sql) === TRUE) {
# code...
// check if the table is set on GET
$mysqli->query($sql1); #command to update store
$mysqli->query($sql2); #command to delete the order
// DELETE KOT AND BOT FROM THIS TABLE 

$tableIDID = $_SESSION['TABLEID'];
$mysqli->query("DELETE FROM  kot WHERE tableItems_id = $id") or die("ERROR 5000");
$mysqli->query("DELETE FROM  bot WHERE tableItems_id = $id") or die("ERROR 5000");

// echo $tableIDID;
header("location: ../table.orders.php?table=$tableIDID");
exit();


}else{
echo mysqli_error($mysqli);

}
}

}
}
// END OF DELETE ORDER FROM THE TABLE

?>