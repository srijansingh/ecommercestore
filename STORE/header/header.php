<?php

?>

<?php

?>
<!DOCTYPE html>
<html>
<head>
<title>Tuanish
  </title>
  <!--<link rel="icon" href="logo1.png" type="image/icon type">-->

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>

  <script type="text/javascript">
    function toggleSideBar()
    {
      document.getElementById("sidebar").classList.toggle('active');
    }
  </script>

<style>
 *{



    -webkit-tap-highlight-color: rgba(255, 255, 255, 0);

}
body {
  font-family: "Lato", sans-serif;
  outline:none;

  touch-action: ;

}
#sidebar{
  position:fixed;
  width:250px;
  top:0px;
  height:100%;
  padding:0px 0px;
  /*background:linear-gradient(45deg, #0e0416,#151719, #0e0416);*/
  background:white;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

  left:-258px;
  transition:0.2s;
}
#sidebar.active{
  left:0px;
  overflow-x:hidden;
  overflow-y:auto;
  height:100%;
}
#sidebar.active::-webkit-scrollbar{

  display:none;
}

.toggle-btn{
 position:fixed;
 left:10px;
 top:8px;

}
.toggle-btn i{
 display:block;
 width:25px;
 height:2px;
 border-radius:1px;
 background:#0e0416;
 margin:5px 0px;

}
#sidebar.active .toggle-btn i{
 position:fixed;
 left:250px;
 background: transparent;
 padding:800px 1000px;
}
li{
  position:relative;
  color:#000;
  padding:12px 15px;
  list-style:none;
  font-size:20px;
  transition:0.3s;

}
li:hover{
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  transition:0.3s;
}


#sidebar a {
  position:relative;
  color:#000;
  text-decoration: none;
  font-size: 16px;
  display: block;
  transition: 0.3s;
}
#sidebar .sidebar-boxed{
  position:relative;
 
}


.head{
  position:fixed;
  top:0px;
  left:0px;
  width:100%;
  background:#fff;
  padding:4px 0px;
  display:inline-block;
  box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 3px 5px 0 rgba(0, 0, 0, 0.19);

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

/*Accordion*/

.accordion {
  background:transparent;
  color: #000;
  cursor: pointer;

  padding:10px 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 17px;
  transition:0.3s;

}

.active, .accordion:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  transition:0.3s;
}
.accordion:hover  #btns{
  transform:rotate(90deg);
}

.panel {
  position:relative;
  width:100%;
  display: none;
  color:#000;
  outline:none;
  overflow-x:hidden;
  overflow-y:auto;
  transition:0.6s ease;
}
.accordion:after {
    /* Unicode character for "plus" sign (+) */
  font-size: 13px;
  color:#000;
  float: right;
  margin-left: 5px;
}

.active:after {

  color:black;          /* Unicode character for "minus" sign (-) */
}
.panel a{
  color:#000;
  text-decoration:none;
  padding:7px 40px;
  transition:0.6s ease;
  overflow-x:hidden;
  overflow-y:auto;
}

.panel a:hover{
  background:#151719;

}
.panel #icn{
  position:relative;
  float:right;
  right:10px;
  color:#000;
}


.sidebarprofile{
  position:fixed;
  margin:0px;
  top:0px;
  width:250px;
    background:#fff;

}
.sidebarprofile h2{
  position:relative;

  margin:0px;

  font-size:29px;
  padding:6px 18px;
  color:#0e0416;

}
.sidebar-details{
  position:relative;
  padding:12px 11px;
  margin:0px;
  padding-bottom:8px;
  color:#d4d4d4;
  font-size:13px;

}
.registration{
  position:relative;
  width:100%;
  
  display:grid;
  grid-template-columns: repeat(2,1fr);
  
  text-align:center;
}
.registration a{
  position:relative;
  width:auto;
  padding:5px;
  text-decoration:none;
  box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.2), 0 4px 2px 0 rgba(0, 0, 0, 0.19);
  margin:4px;
  border-radius:5px 10px;
}

/**/


/**/


</style>
</head>
<body>


  <div class="head">



      <div class="header">

     <a href="indexs.php?search"><i class='fas fa-search' id="acc" style="color:#000;"></i></a>
     <a href="index.php"><i class='fas fa-home' id="acc" style="color:#000"></i></a>

      <a href="indexs.php?myaccount"><i class='fas fa-user-circle' id="acc" style="color:#1a1a1a"></i></a><!--For account-->
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

    </div>
  </div>

<!---->
<div   id="sidebar">

  <div class="toggle-btn" onclick="toggleSideBar()">
    <i></i>
    <i></i>
    <i></i>
  </div>

  <?php 
  if(isset($_SESSION['customer_email']))
  {
    echo '<div class="sidebar-boxed" style="position:relative;top:45px">';
  }
  else
  {
    echo '<div class="sidebar-boxed" style="position:relative;top:80px">'; 
  }
  ?>
  


<p class="sidebar-details">Shop By</p>
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
      <button class='accordion'><i class='fa fa-angle-right' id='btns' style='color:deepskyblue;'></i>&nbsp;&nbsp;".$result['product_cat_title']."</button>";
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
              <a href='indexs.php?c=".$result['cat_title']."'>".$result['cat_title']."</a>

          ";

        }
        echo "</div>";
      }
  }
}
?>
  <p class="sidebar-details">Your Account</p>
  <a href="indexs.php?myorders"><li><i class='fab fa-first-order'style="color:green" ></i>&nbsp;&nbsp;My Orders</li></a><!--MY ORDERS-->


  <a href="indexs.php?carts"><li><i class='fas fa-shopping-bag'  style="color:orange"></i>&nbsp;&nbsp;My  Cart</li></a>

  <a href="indexs.php?myaccount" ><li><i class='fas fa-user-circle'  style="color:deepskyblue"></i>&nbsp;&nbsp;My  Account</li></a>

  <!--Contact sidebar-->

  <p class="sidebar-details">Contact</p>

  <a href="tel:8707849506" ><li><i class="fa fa-phone"  style="color:lawngreen"></i>&nbsp;&nbsp;Call Us</li></a>
  <a href="mailto:srijan.singh.1232@gmail.com?subject=My Feedback" ><li><i class="fas fa-pencil-alt"  style="color:#ff5500"></i>&nbsp;&nbsp;Write to us</li></a>


  <p class="sidebar-details">Legal</p>

    <a href="#"><li><i class="far fa-question-circle"  style="color:deepskyblue"></i>&nbsp;&nbsp;Help</li></a>
    <a href="#"><li><i class="fas fa-exchange-alt" style="color:red"></i>&nbsp;&nbsp;Our Policies</li></a>


 <!-- <a href="#" class="contact" ><font><i class="fa fa-legal" id="m_icon" style="color:red"></i>Legal</font></a>-->

</div>
<div class="sidebarprofile">

  <?php
    if(isset($_SESSION['customer_email']))
    {
      $customer_email=$_SESSION['customer_email'];
      $query="SELECT * FROM customers WHERE customer_email=:customer_email";
      $run=$pdo->prepare($query);
      $run->bindParam(":customer_email",$customer_email,PDO::PARAM_STR);
      $run->execute();
      $row=$run->fetchAll(PDO::FETCH_ASSOC);
      foreach($row as $rows)
      {
        $customer_fname=$rows['customer_fname'];
      }
      echo '
      <h2><i class="fa fa-user" style="color:deepskyblue;"></i>&nbsp;&nbsp;'.$customer_fname.'<a class="right"  style="position:relative;float:right;font-size:20px;padding:8px" href="indexs.php?logout"><i class="fa fa-power-off" style="color:black;"></i></h2>';
    }
    else {
      echo '
        <h2><i class="fa fa-user-circle"></i>&nbsp;&nbsp;Welcome</h1>';
        echo '
        <div class="registration">
          <a href="indexs.php?login">Login</a>  <a href="indexs.php?signup">Signup</a>
        </div>';
    }
   ?>
</div>
</div>

<!--Header navigation bar-->



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



</body>
</html>
