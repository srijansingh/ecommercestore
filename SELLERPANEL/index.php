<head>
  <style media="screen">
    *{
    -webkit-tap-highlight-color: transparent;
    }
  </style>
</head>
<?php
  session_start();
  require 'CONFIGURE/config.inc/dbh.config.php';
  if(!isset($_SESSION['seller_email']))
  {
    header("Location: SellerAuth\login.sell.php");
  }
  else
  {
    $seller_email=$_SESSION['seller_email'];
    $seller_username=$_SESSION['seller_username'];
    $query="SELECT * FROM seller WHERE seller_email=:seller_email";
    $run=$pdo->prepare($query);
    $run->bindParam(':seller_email',$seller_email,PDO::PARAM_STR);
    $run->execute();
    $row=$run->fetchAll(PDO::FETCH_ASSOC);

    foreach($row as $rows)
    {
      $seller_id=$rows['seller_id'];
      $seller_name=$rows['seller_fname'].' '.$rows['seller_lname'];
      $seller_fname=$rows['seller_fname'];
      $seller_shop=$rows['shop_name'];
      $seller_contact=$rows['seller_contact'];
      $seller_city=$rows['seller_city'];
      $seller_address=$rows['seller_address'];
      $seller_link=urldecode($rows['seller_link']);
      $seller_image=$rows['seller_image'];

    }

    #For product
    $order_confirmed='Confirmed';
    $order_delivered='Delivered';

    $query="SELECT * FROM products WHERE product_seller=:product_seller ";
    $run=$pdo->prepare($query);
    $run->bindParam(':product_seller',$seller_email,PDO::PARAM_STR);

    $run->execute();
    $count_products=$run->rowCount();


    #for order

    $query="SELECT * FROM pending_orders WHERE product_seller=:product_seller AND order_status=:order_status";
    $run=$pdo->prepare($query);
    $run->bindParam(':product_seller',$seller_email,PDO::PARAM_STR);
    $run->bindParam(':order_status',$order_confirmed,PDO::PARAM_STR);

    $run->execute();
    $count_orders=$run->rowCount();


    #for total Selling

    $query="SELECT * FROM pending_orders WHERE product_seller=:product_seller AND order_status=:order_status";
    $run=$pdo->prepare($query);
    $run->bindParam(':product_seller',$seller_email,PDO::PARAM_STR);
    $run->bindParam(':order_status',$order_delivered,PDO::PARAM_STR);
    $run->execute();
    $count_deliveries=$run->rowCount();
    $row=$run->fetchAll(PDO::FETCH_ASSOC);
    $due_amount=0;
    foreach($row as $rows)
    {
      $due=$rows['due_amount'];
      $due_amount += $due;

    }

      if(isset($_GET['insert']))
      {
        require 'template/insert/insert.sell.php';
        require 'template/frame/frame.sell.php';
      }
      if(isset($_GET['dashboard']))
      {

        require 'template/monitor/dash.sell.php';
        require 'template/frame/frame.sell.php';
      }
      if(isset($_GET['view']))
      {
        require 'template/monitor/view.sell.php';
        require 'template/frame/frame.sell.php';
      }
      if(isset($_GET['details']))
      {
        require 'template/monitor/infopic.php';

      }
      if(isset($_GET['delete']))
      {
        require 'template/remove/delete.php';

      }
      if(isset($_GET['logout']))
      {
        require 'SellerAuth/logout.php';

      }
      if(isset($_GET['profile']))
      {
        require 'account/myaccount.php';
        require 'template/frame/frame.sell.php';
      }
      if(isset($_GET['myorder']))
      {
        require 'template/monitor/myorder.sell.php';
        require 'template/frame/frame.sell.php';
      }
      if(isset($_GET['deliver']))
      {
        require 'template/monitor/delivered.php';
        require 'template/frame/frame.sell.php';
      }
    }

 ?>
