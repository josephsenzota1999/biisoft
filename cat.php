<?php 
session_start();
include "includes/start.php";
// other code goes here
if (isset($_POST['addCat'])) {
   $cname = $mysqli->escape_string($_POST['cname']);
   $status =  $mysqli->escape_string($_POST['status']);
   $time = time();

   // echo $cname.$status;
   // check if there is empty value then display error
   if (empty($cname) || empty($status)) {
       # code...
        echo "<script> alert('All field are required!')</script>";
   }else{
        // check if the category is already exist
        $cat = $mysqli->query("SELECT * FROM categories WHERE categories_deleted = 0 && categories_name = '$cname'");
        $catCount = mysqli_num_rows($cat);
        // echo $catCount;
        if ($catCount > 0) {
            # code...
        echo "<script> alert('This Category already exist!')</script>";
        // header("location: cat.php?ee=ee");

        }else{
            // insert into the database 
    $mysqli->query("INSERT INTO categories(categories_name,categories_status,categories_time) VALUES('$cname','$status','$time')") or die("ERROR 5000");
        echo "<script> alert('New Category is Added!')</script>";
// exit();
        }
        
   }


}

// UPDATE THE CATEGORY TABLE
if (isset($_POST['catUpdate'])) {
   $id = $mysqli->escape_string($_POST['id']);
   $cname = $mysqli->escape_string($_POST['cname']);
   $status =  $mysqli->escape_string($_POST['status']);
   $time = time();
   // echo $id;
   // check if there is empty value then display error
   if (empty($cname) || empty($status)) {
       # code...
        echo "<script> alert('All field are required!')</script>";
   }else{
    // what if some hacker mess with id on hidden input?
     // insert into the database 
    $mysqli->query("UPDATE categories SET categories_name = '$cname',categories_status = '$status',categories_time = '$time' WHERE categories_id = $id") or die("ERROR 5000");
        header("location: cat.php?msg= Category is Updated!");
        // echo "<script> alert('Category is Updated!')</script>";

}
}
// DELETE THE CATEGORY 
if (isset($_GET['delete'])) {
                    # code...
                    $id = $_GET['delete'] ?? NULL;
                    $dltTime = time();
                    $dltBy = 'unkown';

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
        $mysqli->query("UPDATE categories SET categories_deleted = 1,categories_dlt_date = '$dltTime', categories_dlt_by = '$dltBy' WHERE categories_id = $id");
            header("location: cat.php?msgd= Category is Deleted!");

        }
    }
}
        
// include header here
include "includes/header.php";
if ($_SESSION['ROLE'] == 1) {
    # code...
?>
<!-- SELECT CAT FOR UPDATE -->

<?php
// SELECT THE CATEGORY
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
        $catSelect = $mysqli->query("SELECT * FROM categories WHERE categories_id = $id && categories_deleted = 0");
        $data = $catSelect->fetch_assoc();
        ?>
<div class="container">
    <div id="catUpdate" class="row">
        <div class="col-md-3">
            
        </div>
        <div class="col-md-5">
            <center>
            <h4>Update Category</h4>

        </center>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $data['categories_id']; ?>">

                 <label for="cname">Category Name:</label>
                            <!-- <input name="xx" type="text" class="form-control" id="cname"   placeholder="eg. Men's Body Lotion" required> -->

                <input type="text" name="cname" id="cname" class="form-control"
                value="<?php echo $data['categories_name']; ?>">
                <label for="status">Select Status:</label>
                <select name="status" class="form-control"id="status">
                    <option value="<?php echo $data['categories_status']; ?>"><?php echo $data['categories_status']; ?></option>
                    <option value="active">Active</option>
                    <option value="notactive">Not Active</option>

                </select>
                <br>
                <input class="btn btn-small btn-info btn-block" name="catUpdate" type="submit" value="UPDATE">
                </form>
        </div>
        <div class="col-md-3">
            
        </div>
    </div>
</div>
<?php

                        }


                    }

                }
?>
<div class="container">
<div id="category" class="row">

<!-- table div  responsive -->
<div class="col-md-2">

</div>
            <!-- middle -->
<div class="col-md-8">
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
    <h4 class="h4 float-left">List of Categories</h4>
    <?php 
            // echo time();
             ?>
            <button type="button" class="btn btn-small btn-info float-right" data-toggle="modal" data-target="#cat">+ ADD CATEGORY</button>
            <!-- modal of cat -->
            <div class="modal fade" id="cat" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- <button class="close" data-dismiss="modal">x</button> -->
                            <h4 class="float-left">+ Add new Category</h4>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                <label for="cname">Category Name:</label>
                            <!-- <input name="xx" type="text" class="form-control" id="cname"   placeholder="eg. Men's Body Lotion" required> -->
                            <input type="text" name="cname" id="cname" class="form-control" required placeholder="eg. Soft Drinks">
                            <label for="status">Select Status:</label>
                            <select name="status" class="form-control"id="status">
                                <option value="active">Active</option>
                                <option value="notactive">Not Active</option>

                            </select>
                            <br>
                            <input class="btn btn-small btn-info btn-block" name="addCat" type="submit" value="+ Add">
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
<input type="search" class="form-control col-md-10" 
oninput="w3.filterHTML('#searchCat','.item',this.value)" placeholder="Search Category here">
            <!-- <p>&nbsp;</p> --><br>
            <table id="searchCat" class="table table-stripe table-responsive table-hover">
                <tr >
                    <th >Category Name</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>



                </tr>
                <?php 
        $cat = $mysqli->query("SELECT * FROM categories WHERE categories_deleted = 0");
        // $data = $cat->fetch_assoc();
        $catCount = mysqli_num_rows($cat);


        // echo $data['categories_deleted'];
        if ($catCount == 0) {
            # code...
            echo "<tr><td>There is no data to display!</td></tr>";

        }else{
            while($rows = $cat->fetch_assoc()):
            ?>
            <tr class="item">
                    <td><?php echo $rows['categories_name']; ?></td>
                    <td><?php echo $rows['categories_status']; ?></td>
                    <td><?php 
                        $time = $rows['categories_time']; 
                        echo date('M d Y H:i:s A',$time);
                    ?></td>
                    <td>
                        <a href="cat.php?edit=<?php echo $rows['categories_id']; ?>" class="btn btn-small btn-info">[] EDIT</a>
                    </td>
                    <td>
                        <a href="cat.php?delete=<?php echo $rows['categories_id']; ?>" class="btn btn-small btn-danger" onclick="return confirm('Are you sure you want to delete?')">x</a>
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