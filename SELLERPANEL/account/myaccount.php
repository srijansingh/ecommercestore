<?php
$head='<a style="color:#000;"><i class="fa fa-user-circle"></i>&nbsp;&nbsp;My Profile</a>';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
      .wrapper{
        position:fixed;
        top:44px;
        width:100%;
        height:100%;
        background:linear-gradient(45deg,white,#e6e6e6,white);
        padding:20px 0px;
      }
      .logo{
        position:relative;
        width:160px;
        height:160px;
        left:50%;
        transform:translate(-50%,0%);
        background:white;
        border-radius:50%;
      }
      .logo img{
        position:relative;
        width:160px;
        height:160px;
        border-radius:50%;
      }
      .name{
        position:relative;
        text-align:center;
        padding:10px 0px;
        font-size:20px;
      }
      .desc{
        position:relative;
        background:#fff;
        margin:20px;
        width:auto;
        padding:20px;
        opacity:0.5;

        border-radius:10px;

      }
      .desc p{
        position:relative;
        padding:10px 0px;
      }
      .desc a{
        position:relative;
        float:right;
        right:5px;

        font-weight:bold;
      }
    </style>
  </head>
  <body>
    <div class="wrapper">
      <div class="logo">
        <img src="<?php echo $seller_image ;?>" alt=""><br>
      </div>
      <div class="name">
      <?php echo $seller_name; ?><br>
      </div>
      <div class="desc">
        <p>Username <a class="right"><?php echo $seller_username; ?></a></p>
        <p>E-mail ID <a class="right"><?php echo $seller_email; ?></a></p>
        <p>Address <a class="right"><?php echo $seller_address; ?></a></p>
        <p>City <a class="right"><?php echo $seller_city; ?></a></p>


      </div>
    </div>
  </body>
</html>
