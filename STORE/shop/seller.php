<?php
  if(isset($_GET['seller']))
  {
    $seller_email=$_GET['seller'];
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
      $seller_address=$rows['seller_address'].' '.$rows['seller_city'].' Pincode : '.$rows['seller_pincode'];
      $seller_link=$rows['seller_link'];
      $seller_image=$rows['seller_image'];
      $seller_cover=$rows['seller_cover'];
      $seller_pin=$rows['seller_pincode'];
    }

  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Shops</title>
    <link rel="stylesheet" href="STORE/css/seller.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <script type="text/javascript">
    function next(){window.history.forward()}
    function back(){window.history.back()}
    function go(){window.history.go(1)}
    </script>
  </head>
  <body>


<div class="wrapper">
  <div class="seller_cover">
    <img src="<?php echo $seller_cover?>" alt="" class="cover">
    <img src="<?php echo $seller_image?>" alt="" class="image_logo">
  </div>

    <h1><?php echo $seller_name; ?></h1>
    <div class="contact_seller">
      <a href="tel:<?php echo $seller_contact ?>" style="background:lawngreen"><i class="fa fa-phone"  ></i>&nbsp;&nbsp;Call</a>
      <a href="mailto:<?php echo $seller_email;?>?subject= My Feedback" style="background:#fe5906"><i class="fas fa-pencil-alt"  ></i>&nbsp;&nbsp;E-Mail</a>
    </div>
    <div class="shop_details">
      <a class="shopitem"><?php echo  $seller_shop;?></a>
      <a class="shopaddress">
       <iframe src="<?php echo $seller_link;?>" class="mapping"  frameborder="0" style="border:0" allowfullscreen></iframe></a>
       <a class="shop_venue">Visit this shop at: <br><b> <?php echo $seller_address;  ?></b></a>
    </div>

    <!-----------------Shop--------------->
    <div class="shop_products" >
      <?php echo $seller_shop; ?>'s Products</h2>
    </div>
    <div class="shop">
    <?php
     $query="SELECT * FROM products  WHERE product_seller=:product_seller";
     $run=$pdo->prepare($query);
     $run->bindParam(':product_seller',$seller_email,PDO::PARAM_STR);
     $run->execute();
     $total=$run->rowCount();
     $row=$run->fetchAll(PDO::FETCH_ASSOC);

     if($total!=0)
     {

      echo  '
       <div class="product">';

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
             $row=$runs->fetchAll(PDO::FETCH_ASSOC);
             $total_img=$runs->rowCount();

             foreach($row as $result_img)
             {

             echo "
                <section>

                <div class='img'><a href='indexs.php?details&product_id=$product_id&$product_title'>
                <img src='data:image/jpeg;base64,".base64_encode($result_img['product_img'])."'></a>
            </div>
             <div class='ptitle'><a href='indexs.php?details&product_id=$product_id&$product_title'>
               ". $product_cat."</a>
             </div>
             <div class='pname'><a href='indexs.php?details&product_id=$product_id&$product_title'>
               ".$product_title."</a>
             </div>
             <div class='price'><a href='indexs.php?details&product_id=$product_id&$product_title'>
               <b>&#x20B9 ".$product_price."</b><del class='del'><i>".$original."</i></del><font class='discount'>".$product_discount."% off</font></a>
             </div>

             </section>
                 ";
             }
         }
     }

   echo "    </div>
    </div>";
    ?>


    <!-----------------Shop--------------->
  </div>




<div class="head_back">
  <a onclick="back()"><i class="fas fa-arrow-left"></i></a>
</div>



</body>
</html>
