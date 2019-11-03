<?php
session_start();
  require 'CONFIGURE/config.inc/dbh.config.php';
?>

<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="manifest" href="manifest.json">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="store/css/index.css">
<link rel="icon" type="image/gif" href="logo1.jpeg" />


<meta name="description" content="Your Store, Your Place">
<meta property="og:title" content="Tuanish Store" />
<meta property="og:url" content="https://www.tuanish.tk" />

<meta property="og:type" content="website" />
<meta property="og:locale" content="en_US" />


<meta property="og:image" content="https://www.srijansingh.tk/logo1.jpeg"/>  
  
<meta property="og:description" content="Your Store Your Place"/>  

</head>
<body>


<div class="image_control">
<div class="slideshow_container">

<?php
  $query="SELECT DISTINCT cat_title from products";
  $run=$pdo->prepare($query);
  $run->execute();
  $i=$run->rowCount();
  $row=$run->fetchAll(PDO::FETCH_ASSOC);
  foreach($row as $result)
  {
      $cat_title=$result['cat_title'];
      $query="SELECT * FROM slider WHERE cat_title='$cat_title'";
      $run_query=$pdo->prepare($query);
      $run_query->execute();
      $row=$run_query->fetchAll(PDO::FETCH_ASSOC);


    foreach($row as $result_row)
    {

        echo "
        <div class='mySlides'>

        <a href='indexs.php?c=".$result['cat_title']."'><img src='data:image/jpeg;base64,".base64_encode($result_row['cat_image'])."'></a>
        </div>
        ";
    }

  }
?>

  <div style='text-align:center'>
  <?php
    $j=1;
    while($j<=$i)
    {
    echo "<span style='display:none' class='dots'></span>";
    $j++;
    }
    ?>
  </div>
</div>
<p align="center" style="position:relative;margin:0px 30px;margin-top:50px;font-size:25px;font-weight:normal;color:#fff;border-radius:20px;padding:8px;text-shadow: 2px 2px 4px #000000;">Categories</p>
<div class="image_verticle">

<?php
  $query="SELECT DISTINCT cat_title from products";
  $run=$pdo->prepare($query);
  $run->execute();
  $row=$run->fetchAll(PDO::FETCH_ASSOC);
  $i=$run->rowCount();

  foreach($row as $result)
  {

      $cat_title=$result['cat_title'];
      $query="SELECT * FROM cat_images WHERE cat_title=:cat_title order by rand()";
      $run_query=$pdo->prepare($query);
      $run_query->bindParam(':cat_title',$cat_title,PDO::PARAM_STR);
      $run_query->execute();
      $row=$run_query->fetchAll(PDO::FETCH_ASSOC);


    foreach($row as $result_row)
    {
        echo "
        <div class='down_img'>
        <a href='indexs.php?c=".$result['cat_title']."'><img src='data:image/jpeg;base64,".base64_encode($result_row['cat_image'])."'></a>

        <p align='center' style='position:relative;padding:8px 0px; font-weight:bold;'>".$cat_title."</p>
        </div>
        ";
    }

}

  ?>
</div>
<p align="center" style="position:relative;margin:0px 30px;margin-top:50px;margin-bottom:10px;color:#fff;font-size:25px;font-weight:normal;width:auto;border-radius:20px;padding:8px;text-shadow: 2px 2px 4px #000000;">Collaborators</p>
<!--FOR SELLER-->
<div class="seller">
  <?php
  $query="SELECT * FROM seller";
  $run=$pdo->prepare($query);
  $run->execute();
  $row=$run->fetchAll(PDO::FETCH_ASSOC);

  foreach($row as $rows)
  {
    $seller_email=$rows['seller_email'];
    echo '
    <div class="seller_image">
    <a href="indexs.php?seller='.$seller_email.'">
      <img src="'.$rows['seller_cover'].'" alt="">
      </a>
      <p align="center" style="position:relative;padding:10px 0px; font-size:20px;font-weight:bold;">'.$rows['seller_city'].'</p>
    </div>
    ';
  }

  ?>



</div>

<!--FOR SELLER ENDS-->
<div class="shop">

   <?php

    $query="SELECT * FROM products  order by rand() LIMIT 0,100";
    $run=$pdo->prepare($query);
    $run->execute();
    $total=$run->rowCount();
    $row=$run->fetchAll(PDO::FETCH_ASSOC);
    if($total!=0)
    {


     echo  '
     <p align="center" style="position:relative;margin:0px 30px;margin-top:50px;font-size:25px;font-weight:normal;color:#fff;border-radius:20px;padding:8px;text-shadow: 2px 2px 4px #000000;">Products</p><div class="product">';




        foreach($row as $result)
        {
            $product_id=$result['product_id'];
            $product_title=$result['product_title'];
            $product_cat=$result['cat_title'];

            $product_code=$result['product_code'];

            $product_cat=$result['cat_title'];
            $product_price=$result['product_price'];
            $product_discount=$result['product_discount'];
            $original=$result['original_price'];

            $querys="SELECT * FROM products_image WHERE product_code=:product_code order by rand() limit 1";
            $runs=$pdo->prepare($querys);
            $runs->bindParam(':product_code',$product_code,PDO::PARAM_STR);
            $runs->execute();
            $total_img=$runs->rowCount();
            $result=$runs->fetchAll();

            foreach($result as $result_img)
            {

            echo "
               <section>

               <div class='img'><a href='indexs.php?details&product_id=$product_id&$product_title'>
               <img src='data:image/jpeg;base64,".base64_encode($result_img['product_img'])."'></a>
           </div>
           
            <div class='pname'><a href='indexs.php?details&product_id=$product_id&$product_title'>
              ".$product_title."</a>
            </div>
            <div class='price'><a href='indexs.php?details&product_id=$product_id&$product_title'>
              <b>&#x20B9 ".$product_price."</b><del class='del'><i>".$original."</i></del><font class='discount'>".$product_discount."% OFF</font></a>
            </div>

            </section>
                ";
            }
        }
    }

  echo "    </div>


  ";

?>
</div> <!--Sop ends-->

<?php require 'STORE/header/media.php'; ?>

</div>

<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var j;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dots");
  for (j = 0; j < slides.length; j++) {
    slides[j].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  for (j = 0; j < dots.length; j++) {
    dots[j].className = dots[j].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display="block";
  dots[slideIndex-1].className +=" active ";
  setTimeout(showSlides, 3000);
}
</script>

</body>
</html>
<?php
  require 'STORE/header/header.php';

?>
