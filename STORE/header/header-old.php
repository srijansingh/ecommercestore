<?php

?>
<!DOCTYPE html>
<html>
<head>
<title>Tuanish
  </title>
  <!--<link rel="icon" href="logo1.png" type="image/icon type">-->

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
<style>
 *{

    -webkit-tap-highlight-color: red;
    -webkit-tap-highlight-color: transparent;
}
body {
  font-family: "Lato", sans-serif;
  outline:none;
  touch-action: none;

}

.sidepanel  {
  position: fixed;
  top:46px;
  width:0;
  bottom:0;
  left: 0;
  background-color: #ffffff;
  padding-bottom:0px;
  overflow-x:hidden;
  overflow-y:auto;
  padding-top:42px;
  transition:0.2s ease;
}

.sidepanel a {
  padding:8px 8px 8px 32px;

  text-decoration: none;
  font-size: 16px;
  overflow-x:hidden;
  overflow-y:auto;
  display: block;
  transition: 0.3s;
}
#m_icon{
  color: #818181;
}
#m_icon:hover{
    background:#f2f2f2;
}


.sidepanel .closebtn {
  position: absolute;
  top: 8px;
  width:250px;
  padding:2px;
  color:#000000;
  font-size:20px;
  outline:none;
}
.closebtn i{
  position:relative;
  float:right;
  right:20px;
}

.head{
  position:fixed;
  top:0px;
  left:0px;
  width:100%;
  background:#fff;
  padding:4px 0px;
  display:inline-block;
  border-bottom:1px solid #d4d4d4;

}
.header{
    position: relative;
    float:right;
    right:10px;
    padding:7px 0px;
    font-size:20px;
}
.header #acc,#car{
  position:relative;
  margin:0px 5px;
}
@media(max-width:768px)
{
  .header{
      right:5px;

  }
  #acc,#car{
    margin:0px 5px;
  }
}

.openbtn {
  font-size: 25px;
  cursor: pointer;
  background:transparent;
  color:#000;
  top:0px;
  left:0px;
  padding: 5px 7px;
  border: none;
  outline:none;
}

.openbtn:hover {
  background-color:transparent;
  color:#1a1a1a;
}
/*Accordion*/

.accordion {
  background:transparent;
  color: #000000;
  cursor: pointer;
  padding:10px 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 17px;
  transition: 0.4s;

}

.active, .accordion:hover {
  background-color:#f2f2f2;
  transition:0.2s;
}

.panel {
  position:relative;
  width:100%;
  display: none;
  color:#000000;
  outline:none;
  overflow-x:hidden;
  overflow-y:auto;
  transition:0.6s ease;
}
.accordion:after {
  content: '\02795';    /* Unicode character for "plus" sign (+) */
  font-size: 13px;
  color:black;
  float: right;
  margin-left: 5px;
}

.active:after {
  content: "\2796";
  color:black;          /* Unicode character for "minus" sign (-) */
}
.panel a{
  color:#000000;
  transition:0.6s ease;
  overflow-x:hidden;
  overflow-y:auto;
}

.panel a:hover{
  background:#f2f2f2;

}
.panel #icn{
  position:relative;
  float:right;
  right:10px;
  color:#a6a6a6;
}

#m_icon{
  position:relative;
  padding:10px 8px;

  color:#000000;
  font-size:18px;

}
#m_icon i{
    position:relative;
  color:lawngreen;
  border:none;
  font-size:18px;
}

.detail{
  position:relative;
  color:#1a1a1a;
  font-size:14px;
  margin-left:5px;
}

.details{
  position:relative;
  color:#1a1a1a;
  margin:0px;


  padding:5px 5px;
}
.details font{
  position:relative;
  font-size:14px;
}
.contact{
  padding: 0px;
  }
.contact font{
  position:relative;
  left:-22px;
  color:#1a1a1a;
  font-size:15px;

}
.contact:hover{
  background:#f2f2f2;
  transition:0.6 ease;

}
.contact #m_icon{
  font-size:17px;
}


</style>
</head>
<body>

<div id="mySidepanel" class="sidepanel">

    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><font class="detail">Categories</font>
    <i class="fa fa-close"></i></a>


  <?php

  $query="SELECT distinct product_cat_title FROM products";
  $run=$pdo->prepare($query);
  $run->execute();
  $total=$run->rowCount();
  $row=$run->fetchAll(PDO::FETCH_ASSOC);


if($total>0)
{
  foreach($row as $result)
  {
    $product_cat_title=$result['product_cat_title'];
    echo "
      <button class='accordion'>".$result['product_cat_title']."</button>";
      $queries="SELECT distinct cat_title FROM products WHERE product_cat_title=:product_cat_title ";
      $runs=$pdo->prepare($queries);
      $runs->bindParam(':product_cat_title',$product_cat_title,PDO::PARAM_STR);
      $runs->execute();
      $totals=$runs->rowCount();
      $row=$runs->fetchAll(PDO::FETCH_ASSOC);
      if($totals>0)
      {
        echo "<div class='panel'>";
        foreach($row as $result)
        {

          echo "
              <a href='indexs.php?c=".$result['cat_title']."'>".$result['cat_title']."<i class='fa fa-chevron-circle-right' id='icn'></i></a>

          ";

        }
        echo "</div>";
      }
  }
}
?>

  <a href="indexs.php?myorders" id="m_icon"><i class='fas fa-shopping-basket' ></i>&nbsp;&nbsp;My Orders</a><!--MY ORDERS-->
  <a href="#" id="m_icon"><i class='fa fa-heart'  style="color:#ff0000"></i>&nbsp;&nbsp;My  Wishlist</a>

  <a href="indexs.php?carts" id="m_icon"><i class='fas fa-shopping-bag'  style="color:orange"></i>&nbsp;&nbsp;My  Cart</a>

  <a href="indexs.php?myaccount" id="m_icon"><i class='fas fa-user-circle'  style="color:deepskyblue"></i>&nbsp;&nbsp;My  Account</a>

  <!--Contact sidebar-->

  <p class="details"><font >Contact</font></p>

  <a href="tel:8707849506"  id="m_icon" ><font><i class="fa fa-phone"  style="color:lawngreen"></i>&nbsp;&nbsp;Call Us</font></a>
  <a href="mailto:srijan.singh.1232@gmail.com?subject=My Feedback"  id="m_icon"><font><i class="fas fa-pencil-alt"  style="color:#ff5500"></i>&nbsp;&nbsp;Write to us</font></a>
  <p class="details"><font >Legal</font></p>
  <a href="#" id="m_icon" ><font><i class="far fa-question-circle"  style="color:deepskyblue"></i>&nbsp;&nbsp;Help</font></a>

  <button class="accordion" style="background:#ffffff;border:none;">Terms and Policies</button>
  <div class="panel">
    <a href="#">Return Policy<i class="fa fa-chevron-circle-right" id="icn"></i></a>
    <a href="#">Shipping Policy<i class="fa fa-chevron-circle-right" id="icn"></i></a>
    <a href="#">Privacy Policy<i class="fa fa-chevron-circle-right" id="icn"></i></a>
  </div>
 <!-- <a href="#" class="contact" ><font><i class="fa fa-legal" id="m_icon" style="color:red"></i>Legal</font></a>-->


</div>

<!--Header navigation bar-->

<div class="head">

<button class="openbtn" onclick="openNav()"><i class="fas fa-bars"></i></button>


    <div class="header">

   <a href="indexs.php?search"><i class='fas fa-search' id="acc" style="color:#000;"></i></a>
   <a href="index.php"><i class='fas fa-home' id="acc" style="color:#000"></i></a>

    <a href="indexs.php?myaccount"><i class='fas fa-user-circle' id="acc" style="color:#1a1a1a"></i></a> <!--For account-->
     <?php
      if(isset($_SESSION['customer_email']))
      {
          $customer_email=$_SESSION['customer_email'];
        $query="SELECT * FROM cart WHERE customer_email=:customer_email";
        $run=$pdo->prepare($query);
        $run->bindParam(':customer_email',$customer_email,PDO::PARAM_STR);
        $run->execute();
        $count_total_products=$run->rowCount();
        echo "
      <a href='indexs.php?carts'><i class='fa fa-shopping-bag' aria-hidden='true' id='car'  style='color:#1a1a1a;'><sup style='position:relative;font-size:12px;padding:2px 4px; color:#fff; background:deepskyblue;left:-4px;;width:30px;height:30px;border-radius:50%;font-weight:normal'> $count_total_products</sup></i></a>
      ";
      }
      else
      {
          echo "
         <a href='indexs.php?carts'><i class='fa fa-shopping-bag' id='car'  style='color:#1a1a1a;'></i></a> ";
      }
      ?>
        <!--For cart-->
  </div>
</div>
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>

<script>
function openNav() {
  document.getElementById("mySidepanel").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidepanel").style.width = "0";
}
</script>

</body>
</html>
