
<html>
    <head>
        <link rel="shortcut icon" href="https://www.srijansingh.tk/logo1.png">
       
        <style>
        *{

        }
        </style>
        
        <title>Tuanish</title>

        <meta name="description" content="Your Store, Your Place">
        <meta property="og:title" content="Tuanish Store" />
        <meta property="og:url" content="https://www.tuanish.tk" />

        <meta property="og:type" content="website" />
        <meta property="og:locale" content="en_US" />


        <meta property="og:image" content="https://www.srijansingh.tk/logo1.jpeg"/>  
          
        <meta property="og:description" content="Your Store Your Place"/>  
        </head>
<?php
ob_start();
error_reporting(0);
function getRealIpUser(){

    switch(true){

          case(!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
          case(!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
          case(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];

          default : return $_SERVER['REMOTE_ADDR'];

    }

}


  require 'CONFIGURE/config.inc/dbh.config.php';

  if(isset($_GET['shop']))
  {
    session_start();
    require 'STORE/shop/shop.php';

  }
  if(isset($_GET['details']))
  {
  session_start();
    require 'STORE/shop/info.php';
    require 'STORE/header/header.php';

  }
  if(isset($_GET['signup']))
  {
    require 'AUTH/signup.php';
  }
  if(isset($_GET['login']))
  {

    require 'AUTH/login.php';
  }
  if(isset($_GET['carts']))
  {
    session_start();
    require 'STORE/shop/cart.php';
    require 'STORE/header/header.php';
  }
  if (isset($_GET['remove']))
  {
    session_start();
    require 'STORE/remove/delete_cart.php';
  }
  if(isset($_GET['c']))
  {
    session_start();
    require 'STORE/shop/category.php';
    require 'STORE/header/header.php';
  }
  if(isset($_GET['payment']))
  {
    session_start();
    require 'STORE/shop/payment.php';

  }
  if(isset($_GET['myaccount']))
  {
    session_start();
    require 'STORE/account/myaccount.php';
    require 'STORE/header/header.php';
  }
  if(isset($_GET['acc_setting']))
  {
    session_start();
    require 'STORE/account/updateacc.php';

  }
  if(isset($_GET['checkout']))
  {
    session_start();
    require 'STORE/shop/checkout.php';
  }
  if(isset($_GET['order']))
  {
    session_start();
    require 'STORE/shop/orderSuccess.php';
  }
  if(isset($_GET['myorders']))
  {
    session_start();
    require 'STORE/shop/myorder.php';
  }
  if(isset($_GET['search']))
  {
    session_start();
    require 'STORE/shop/search.php';
  }
  if(isset($_GET['infopic']))
  {
    session_start();
    require 'STORE/shop/infopic.php';
  }
  if(isset($_GET['logout']))
  {
    require 'AUTH/logout.php';
  }
  if(isset($_GET['seller']))
  {
    require 'STORE/shop/seller.php';
  }
  ob_end_flush();
?>
</html>