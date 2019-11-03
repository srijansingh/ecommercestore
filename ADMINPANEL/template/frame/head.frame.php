<!DOCTYPE html>
<?php
    require 'configure/dbh.config.php';
    if(!isset($_SESSION['admin_email']))
    {
        header('Location: ');
        exit();
    }
    else
    {
?>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

<link rel="stylesheet" href="css/head.frame.css">
</head>

<body>

   <div class="side">
    <div class="side-bar">

            <a href="index.php?dashboard"><i class="fas fa-eye" id="awe"></i>Dashboard</a>
            <a href="index.php?insert_products"><i class="fas fa-tasks" id="awe"></i>Insert Products</a>
            <a href="index.php?view_products"><i class="fas fa-tasks" id="awe"></i>View Products</a>
            <a href="index.php?insert_products_categories"><i class="fas fa-tags" id="awe"></i>Main Categories</a>
            <a href="index.php?insert_categories"><i class="fas fa-tags" id="awe"></i>Insert Categories</a>
            <a href="index.php?view_cat"><i class="fas fa-tags" id="awe"></i>View Categories</a>
            <a href="index.php?slider"><i class="fas fa-tags" id="awe"></i>Slider</a>
            <a href="index.php?view_customer"><i class="fa fa-eye" id="awe"></i>View Customers</a>
            <a href="index.php?view_order"><i class="fas fa-shopping-cart" id="awe"></i>View Orders</a>
            <a href="index.php?insert_user"><i class="fas fa-user" id="awe"></i>Insert User</a>
            <a href="index.php?insert_seller"><i class="fas fa-user" id="awe"></i>Insert Seller</a>
            <a href="index.php?view_user"><i class="fas fa-users" id="awe"></i>View Users</a>
            <a href="index.php?logout"><i class="fas fa-sign-out-alt" id="awe"></i>Logout</a>
    </div>
    </div>
     <div class="header">
      <a href="index.php?dashboard"><li><h1>Admin Area</h1></li></a>
         <li class="names"><h2><i class="fa fa-user" id="awe"></i><?php echo $name ; ?></h2></li>
  </div>
</body>
</html>
<?php
}
