<?php
include('admin/includes/header.php');
include('admin/includes/sidebar.php');
include('admin/includes/topbar.php');
include('../config.php');

// Display Products
$limit = 2;
if(isset($_GET['pg'])){
 $pgno = $_GET['pg'];
    
} else{
    $pgno = 1;
}
$initial = ($pgno - 1) * $limit;
$product_query = "SELECT * FROM `products` as p inner join category as c on p.category = c.cid  order by id DESC limit {$initial}, {$limit}";
$conn_query = mysqli_query($connection, $product_query);
if(mysqli_num_rows($conn_query) > 0){




?>


<div class="container">

    <!-- Outer Row -->
<div class="row justify-content-center">

<div class="col-xl-10 col-lg-12 col-md-9">
    <h2>All Categories </h2>
    <hr>
<table class="table table-warning text-center" >
    <thead class="bg-warning p-2 text-dark bg-opacity-10" style="opacity: 75%;">
        <tr>
        <th scope="col">Id</th>
        <th scope="col">Title</th>
        <th scope="col">Category</th>
        <th scope="col">Description</th>
        <th scope="col">Image</th>
        <th scope="col">Action</th>
        <th scope="col">Update</th>
        <th scope="col">Delete</th>
        </tr>
    </thead>
    <tbody style=" font-size: 20px;">
        <?php 
            while($pro_data = mysqli_fetch_assoc($conn_query)){

        ?>
        <tr>
        <th scope="row"><?php echo $pro_data['id']?></th>
        <td><?php echo $pro_data['title']?></td>
        <td><?php echo $pro_data['cname']?></td>
        <td><?php echo $pro_data['description']?></td>
        <td><img src="<?php echo 'images/' . $pro_data['image']?>" alt="" width="100px" height="100px"></td>
        
        <td><?php
        if($pro_data['status'] == 1){
            echo "Active";
        }else{
            echo "Deactivate";
        }
        ?></td>
        <td><a class="btn btn-primary" href="update.php?pid=<?php echo $pro_data['id']?>"> Update </a></td>
        <td><a class="btn btn-danger" href=""> Delete </a></td>
        
    </tr>
    <?php
        }
    }
    
    
    ?>
    
    </tbody>
</table>
<?php
$pagination = "SELECT * FROM `products`";
$res = mysqli_query($connection, $pagination);
if(mysqli_num_rows($res) > 0){
    $total_records = mysqli_num_rows($res);
    $total_pg = ceil($total_records / $limit);
    echo '<ul class="pagination">';
    if($pgno > 1){
        echo '<li class="page-item"><a class="page-link" href="showproducts.php?pg='.($pgno - 1).'">Prev</a></li>';
        
    }
    for($i = 1; $i <= $total_pg; $i++){
        $active = $i == $pgno? 'active':'';
        echo '<li class="page-item '.$active.'"><a class="page-link" href="showproducts.php?pg='.$i.'">'.$i.'</a></li>';
    }
    if($pgno < $total_pg){
        echo '<li class="page-item"><a class="page-link" href="showproducts.php?pg='.($pgno + 1).'">Next</a></li>';

    }
    echo '</ul>';
}

?>



        </div>

    </div>

</div>


</body>

</html>










<?php
include('admin/includes/footer.php');


?>