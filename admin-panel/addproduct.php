<?php
include('admin/includes/header.php');
include('admin/includes/sidebar.php');
include('admin/includes/topbar.php');
include('../config.php');


if(isset($_POST['addproduct'])){
    $pro_title = $_POST['title'];
    $pro_cat = $_POST['category'];
    $pro_des = $_POST['des'];
    $img_name = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $img_size = $_FILES['image']['size'];
    
    move_uploaded_file($tmp_name , 'images/' . $img_name);
    $insert_file = "INSERT INTO `products` (`title`, `category`, `description`, `image`) VALUES ('$pro_title', '$pro_cat', '$pro_des', '$img_name')";
    $conn_pro = mysqli_query($connection, $insert_file);


}



?>


    <div class="container">

        <!-- Outer Row -->
        <!-- category addition through php -->

        <?php 
        if(isset($_POST['addcategory'])){
            $category = $_POST['category'];
            $insertcat = "INSERT into category(`cname`)values ('$category')";
            $conn_cat = mysqli_query($connection, $insertcat);

        }
        
        ?>
        <div class="row justify-content-center">
        <!-- Category Table -->
            <div class="col-xl-10 col-lg-12 col-md-9">
                <h2>Add Category</h2>
                <!-- Category form -->
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user" id="exampleFirstName"
                            placeholder="Add Category" name="category" required>
                        </div>
                        <div class="col-sm-6">
                            <input type="submit" class="btn btn-primary" id="exampleLastName"
                            placeholder="product category" value="Add Category" name="addcategory" required>
                        </div>
                    </div>
                    <!-- Product Table -->
                    <h2>Add Product</h2>
                </form>
                <hr>
                
                <!-- Product Form -->
        <form class="user" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                <select class="form-select" name="category" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <?php 
                    $fetch_cat = "SELECT * from `category` where cstatus = '1'";
                    $con = mysqli_query($connection, $fetch_cat);
                    if(mysqli_num_rows($con) > 0){
                        
                        while($data = mysqli_fetch_assoc($con)){
                        echo '<option value="'.$data['cid'].'">'.$data['cname'].'</option>'; 
                        }
                    }

                    ?>
                                       
                </select>
                    
                </div>
                <div class="col-sm-6">
                <input type="text" class="form-control form-control-user" id="exampleFirstName"
                        placeholder="product Title" name="title" required>
                 </div>
            </div>
            <div class="form-group">
            <div class="form-floating">
                    <textarea class="form-control" name="des" placeholder="Product description" id="floatingTextarea"></textarea>
            </div>
            </div>
            <div class="form-group row">
                
                <div class="col-sm-12">
                    <input type="file" class="form-control"
                        id="exampleRepeatPassword" placeholder="add image" name="image" required>
                </div>
            </div>
          
            <input type="submit" class="btn btn-primary btn-user btn-block" name="addproduct" >
            <hr>
            
                                
        </form>

            </div>

        </div>

    </div>


</body>

</html>










<?php
include('admin/includes/footer.php');


?>