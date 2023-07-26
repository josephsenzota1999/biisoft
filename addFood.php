<?php 
session_start();

include "includes/start.php";
// other code goes here
if (isset($_POST['addPro'])) {
   $pname = $mysqli->escape_string($_POST['pname']);
   $status =  $mysqli->escape_string($_POST['status']);
   $cat =  $mysqli->escape_string($_POST['cat']);
   $price = $mysqli->escape_string($_POST['price']);
   $time = time();
   // echo $cname.$status;
   // check if there is empty value then display error
   if (empty($pname) || empty($status) || empty($cat) | empty($price)) {
       # code...
        echo "<script> alert('All field are required!')</script>";
        // exit();
   }else{
        // check if the category is already exist
        $product = $mysqli->query("SELECT * FROM foodMenu WHERE food_deleted = 0 && food_name = '$pname'");
        $proCount = mysqli_num_rows($product);
        // echo $catCount;
        if ($proCount > 0) {
            # code...
        echo "<script> alert('This Menu already exist!')</script>";
        // exit();
        // header("location: cat.php?ee=ee");

        }else{
            // check if the $price is a number or not
            if (!is_numeric($price)) {
                # code...
        echo "<script> alert('Price must be a number')</script>";

            }else{
            // insert into the database 
    $sql = "INSERT INTO foodMenu(food_name,food_cat,food_price,food_status,food_time) VALUES('$pname','$cat','$price','$status','$time')";

     
// INSERT TO THE TABASE
     if ($mysqli->query($sql) === TRUE) {
         # code...
        echo "<script> alert('Successfully is Added!')</script>";
        // exit();

     }else{
        echo mysqli_error($mysqli);
     }
        
        }
        }
        
   }


}

// UPDATE THE Drink TABLE
if (isset($_POST['proUpdate'])) {
   $id = $mysqli->escape_string($_POST['id']);
   $pname = $mysqli->escape_string($_POST['pname']);
   $status =  $mysqli->escape_string($_POST['status']);
   $cat =  $mysqli->escape_string($_POST['cat']);
   $price = $mysqli->escape_string($_POST['price']);

   $time = time();
   // echo $id;
   // check if there is empty value then display error
   if (empty($pname) || empty($status) || empty($cat) || empty($price)) {
       # code...
        echo "<script> alert('All field are required!')</script>";
   }else{
    // SELECT * FORM PRODUCTS
    $selectProducts = $mysqli->query("SELECT food_name FROM foodMenu WHERE food_id = $id") or die("ERROR 5000");
    $ogPname = $selectProducts->fetch_assoc()['food_name'];
    // echo $ogPname;
    // what if some hacker mess with id on hidden input?
    // check if the price is number
    if (!is_numeric($price)) {
                # code...
        echo "<script> alert('Price must be a number')</script>";

            }else{
    $sql = "UPDATE foodMenu SET food_name = '$pname',food_status = '$status',food_time = '$time', food_cat = '$cat', food_price = '$price' WHERE food_id = $id";
    
        
        // echo "<script> alert('Category is Updated!')</script>";

        // INSERT TO THE TABASE
     if ($mysqli->query($sql) === TRUE) {
         # code...
        header("location: addFood.php?msg= Menu is Updated!");
        exit();

     }else{
        echo mysqli_error($mysqli);
     }
 }
}
}
// DELETE THE MENU 
if (isset($_GET['delete'])) {
                    # code...
                    $id = $_GET['delete'] ?? NULL;
                    $dltTime = time();
                    $dltBy = $_SESSION['USERNAME'];
                    // echo $id;
                    // check if the $id is number
    // SELECT * FORM PRODUCTS
    $selectProducts = $mysqli->query("SELECT food_name FROM foodMenu WHERE food_id = $id") or die("ERROR 5000");
    $ogPname = $selectProducts->fetch_assoc()['food_name'];
                    if (!is_numeric($id)) {
                        # code...
        echo "<script> alert('ERROR 5000')</script>";

                    }else{
                        // check the length of the id
                        if ($id >1000000) {
                            # code...
        echo "<script> alert('ERROR 5000')</script>";

                        }else{
        $sql ="UPDATE foodMenu SET food_deleted = 1,food_dlt_date = '$dltTime',food_dlt_by = '$dltBy' WHERE food_id = $id";

 // INSERT TO THE TABASE
     if ($mysqli->query($sql) === TRUE) {
         # code...
        $mysqli->query($sql1);
header("location: addFood.php?msgd= Menu is Deleted!");     
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
        $catSelect = $mysqli->query("SELECT * FROM foodMenu WHERE food_id = $id && food_deleted = 0");
        $data = $catSelect->fetch_assoc();
        ?>
<div class="container">
    <div id="proUpdate" class="row">
        <div class="col-md-3">
            <!-- right -->
        </div>
        <div class="col-md-5">

                        <center>
                            <h4>Update Menu</h4>
                        </center>
                        
            
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $data['food_id']; ?>">

                 <label for="pname">Name:</label>
                            <!-- <input name="xx" type="text" class="form-control" id="cname"   placeholder="eg. Men's Body Lotion" required> -->
                            <input type="text" name="pname" id="pname" class="form-control" 
                            value="<?php echo $data['food_name']; ?>">
                            <label for="price">Price:</label>
                <input type="number" id="price" name="price" class="form-control" required
                value="<?php echo $data['food_price']; ?>">
                            <label for="cat">Select Category:</label>
                            <select name="cat" class="form-control"id="cat">
                                <?php
        $cat = $mysqli->query("SELECT * FROM categories WHERE categories_deleted = 0");
        // $catData = $cat->fetch_assoc();
                                 while($data = $cat->fetch_assoc()):   

                                ?>
                                <option value="<?php echo $data['categories_id'];?>">
                                    <?php echo $data['categories_name'];?>
                                </option>
                                <?php 
                            endwhile;
                            ?>
                            </select>

                            <label for="status">Status:</label>
                             <select name="status" class="form-control"id="status">
                                <option value="active">Active</option>
                                <option value="notactive">Not Active</option>

                            </select>
                            <br>
                            <input class="btn btn-small btn-info btn-block" name="proUpdate" type="submit" value="Update">
                </form>

            </div>
        <div class="col-md-1">
            <!-- right -->
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
<div id="products" class="row">

<!-- table div  responsive -->
<div class="col-md-1">

</div>
            <!-- middle -->
<div class="col-md-9">
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
                <h4 class="h4 float-left">List From Food Menu</h4>

            <button type="button" class="btn btn-small btn-info float-right" data-toggle="modal" data-target="#product">+ ADD NEW FOOD</button>
            <center><a href="food.php"> << Back to food panel</a></center>
            <!-- modal of cat -->
            <div class="modal fade" id="product" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- <button class="close" data-dismiss="modal">x</button> -->
                            <h4 class="float-left">+ Add new Food</h4>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                <label for="pname">Name:</label>
                            <!-- <input name="xx" type="text" class="form-control" id="cname"   placeholder="eg. Men's Body Lotion" required> -->
                            <!-- <input type="text" name="pname" id="pname" class="form-control" required placeholder="eg. Tea Masala"> -->
                            <select class="form-control" name="pname" id="pname" required>
                                <option>Ugali Nyama</option>
                                <option>Wali Mahare</option>
                                <option>Pizza</option>
                                <option>Burger</option>
                                <option>Pilau Kuku</option>
                                <option>Pilau Mbuzi</option>
                                <option>Chips Kavu</option>
                                <option>Chips Mayai</option>
                                <option>Matunda</option>
                                <option>Biriani</option>


                            </select>
                            <label for="cat">Select Category:</label>
                            <select name="cat" class="form-control"id="cat">
                                <?php
        $cat = $mysqli->query("SELECT * FROM categories WHERE categories_deleted = 0");
                                 while($data = $cat->fetch_assoc()):   

                                ?>
                                <option value="<?php echo $data['categories_id'];?>">
                                    <?php echo $data['categories_name'];?>
                                </option>
                                <?php 
                            endwhile;
                            ?>
                            </select>
                            <label for="price">Price:</label>
                            <input type="number" name="price" id="price" class="form-control" required placeholder="eg. 5000">
                            <label for="status">Status:</label>
                             <select name="status" class="form-control"id="status">
                                <option value="active">Active</option>
                                <option value="notactive">Not Active</option>

                            </select>
                            <br>
                            <input class="btn btn-small btn-info btn-block" name="addPro" type="submit" value="+ Add">
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <p>
                <input type="search" class="form-control" placeholder="Search From Menu..."
                oninput="w3.filterHTML('#searchTable','.item',this.value)">
            </p>
            <table id="searchTable" class="table table-stripe table-responsive table-hover">
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status </th>
                    <th>date </th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>



                </tr>
                <?php 
        $product = $mysqli->query("SELECT food_id,food_name,categories_name,food_price,food_status,food_time FROM foodMenu,categories WHERE food_cat = categories_id && food_deleted = 0 ORDER BY food_time DESC");
        // $data = $cat->fetch_assoc();
        $proCount = mysqli_num_rows($product);
// echo $proCount;

        // echo $data['categories_deleted'];
        if ($proCount == 0) {
            # code...
            echo "<tr><td>There is no data to display!</td></tr>";

        }else{
            while($rows = $product->fetch_assoc()):
            ?>
            <tr class="item">
                    <td><?php echo $rows['food_name']; ?></td>
                    <td><?php echo $rows['categories_name']; ?></td>
                    
                    <td><?php echo $rows['food_price']." TZs"; ?></td>
                    <td><?php echo $rows['food_status']; ?></td>

                    <td><?php 
                        $time = $rows['food_time']; 
                        echo date('M d Y H:i:s A',$time);
                    ?></td>
                    <td>
                        <a href="addFood.php?edit=<?php echo $rows['food_id']; ?>" class="btn btn-small btn-info">[] EDIT</a>
                    </td>
                    <td>
                      <?php 
                            // check if the user is admin then show delete btn 
                        if ($_SESSION['ROLE'] == 1) {
                            # code...
                            ?>
        <a href="addFood.php?delete=<?php echo $rows['food_id']; ?>" class="btn btn-small btn-danger" onclick="return confirm('Are you sure you want to delete?')">x</a>
                        <?php }else{
                            // echo "";
                        }
                            
                         ?>

                    </td>

            </tr>

            <?php 
        endwhile;
        }

                ?>
                
                
        
</table>
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