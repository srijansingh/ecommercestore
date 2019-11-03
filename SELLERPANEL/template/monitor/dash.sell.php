<?php
$head='<i class="fa fa-dashboard"></i>&nbsp;&nbsp;Dashboard';
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>

    <meta charset="utf-8">
    <title>Dashboard</title>
    <style media="screen">
    .boxing{
      position:absolute;
      left:0px;
      top:44px;
      width:100%;
    }
      .wrapper{
        position:relative;
        margin:10px;
        width:auto;
        display:grid;
        grid-template-columns: repeat(1,1fr);

      }
      .band{
        position:relative;
        background:#f1f1f1;
        font-size:25px;
        padding:15px 25px;
        border-bottom:1px solid #d5d5d5;
      }
      section{
        position:relative;
        width:auto;
        margin:8px 25px;
        padding:10px 15px;
        border:1px solid #e6e6e6;
        border-radius:20px;
      }
      .total{
        padding:15px 5px;
        font-size:25px;
        color:white;
      }
      .demo{
          position:relative;
        padding-top:8px;
      }
      .demo a{
        position:relative;
        width:100%;
        color:white;

        font-size:15px;
        text-decoration:none;
      }
      .right{
        position:relative;
        float:right;
        right:3px;
      }
      @media(min-width:786px)
      {
        .wrapper{
          position:relative;
          display:grid;
          grid-template-columns: repeat(2,1fr);

        }
        section{
          position:relative;
          width:auto;
          margin:15px 60px;
          padding:20px 15px;
          border:1px solid #e6e6e6;
          border-radius:20px;
        }
        .demo{
            position:relative;
          padding-top:15px;
        }
      }
    </style>
  </head>
  <body>
    <div class="boxing">



      <div class="wrapper">
      <section style="background:red;">
        <div class="total" style="border-bottom:1px solid #fff;">
          <i class="fa fa-plus"></i>&nbsp;Add Products <a class="right"></a>
        </div>
        <div class="demo">
          <a href="index.php?insert">Add Products</a>
        </div>
      </section>

      <section style="background:blue;">
        <div class="total" style="border-bottom:1px solid #fff;" >
          <i class="fa fa-eye"></i>&nbsp;Total  Products <a class="right"><?php echo $count_products; ?></a>
        </div>
        <div class="demo">
          <a href="index.php?view">View Products</a>
        </div>
      </section>

      <section style="background:#fe5906;">
        <div class="total" style="border-bottom:1px solid #fff;">
          <i class="fa fa-first-order"></i>&nbsp;New Orders <a class="right"><?php echo $count_orders; ?></a>
        </div>
        <div class="demo">
          <a href="index.php?myorder">View Orders</a>
        </div>
      </section>

      <section style="background:green;">
        <div class="total" style="border-bottom:1px solid #fff;">
          <i class="fa fa-buysellads"></i>&nbsp;Total Sellings <a class="right"><i class="fa fa-inr"></i>&nbsp;<?php echo $due_amount;?></a>
        </div>
        <div class="demo">
          <a href="index.php?deliver">Total Delivery &nbsp; </a>
        </div>
      </section>

    </div>
    </div>
  </body>
</html>
