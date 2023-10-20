<?php
    include('admin/includes/header.php');
if(!isset($_SESSION['useremail'])){
    header('location:login.php');
}
// print_r($_SESSION['useremail']);
include('admin/includes/sidebar.php');
include('admin/includes/topbar.php');
include('admin/includes/footer.php');

 


?>