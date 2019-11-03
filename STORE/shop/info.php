<?php



    if(isset($_SESSION['customer_email']))
    {
      $customer_email=$_SESSION['customer_email'];
      $query="SELECT * FROM customers WHERE customer_email=:customer_email";
      $run=$pdo->prepare($query);
      $run->bindParam(':customer_email',$customer_email,PDO::PARAM_STR);
      $run->execute();
      $result=$run->fetch(PDO::FETCH_ASSOC);
      $customer_pincode=$result['customer_pincode'];
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="STORE/css/info.css">


</head>
<body>


<?php

    if(isset($_GET['details']))
    {
        $product_id=$_GET['product_id'];
        $query="SELECT * FROM products WHERE product_id='$product_id'";
        $run=$pdo->prepare($query);
        $run->bindParam(':product_id',$product_id,PDO::PARAM_INT);
        $run->execute();
        $row=$run->fetchAll(PDO::FETCH_ASSOC);

        foreach($row as $result)
        {

            $product_title=$result['product_title'];
            $product_price=$result['product_price'];
            $original_price=$result['original_price'];
            $product_discount=$result['product_discount'];
            $product_desc=$result['product_desc'];
            $product_cat=$result['cat_title'];
            $product_code=$result['product_code'];
            $product_sizing=$result['product_sizing'];
            $product_color=$result['product_color'];
            $product_pattern=$result['product_pattern'];
            $product_brand=$result['product_brand'];
            $product_brand_info=$result['product_brand_info'];
            $product_fabric=$result['product_fabric'];
            $seller_shop=$result['product_seller'];

      }

    }

?>


<div class="detail">
  <!-------------For Mobile----------------->
    <div class="slideshow-container">

    <?php
        $query_pic="SELECT * FROM products_image WHERE product_code=:product_code";
        $run_pic=$pdo->prepare($query_pic);
        $run_pic->bindParam(':product_code',$product_code,PDO::PARAM_STR);
        $run_pic->execute();
        $tot=$run_pic->rowCount();
        $row_pic=$run_pic->fetchAll(PDO::FETCH_ASSOC);
        foreach($row_pic as $result_pic)
        {
          echo '

          <div class="mySlides fade">
          <a href="indexs.php?infopic&product_code='.$product_code.'&p='.$product_title.'">
          <img src="data:image/jpeg;base64,'.base64_encode($result_pic['product_img']).'">
          </a>

          </div>

          ';


        }
        ?>
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>

        <div class="title">
          <?php
          echo $product_title;
          ?>
        </div>

        <div class="pricing">
             <b class="p_price">&#x20B9; <?php echo $product_price ;?></b><font class='discount'><?php echo $product_discount ;?>% OFF</font></a>
        </div>
        <div class="your_price">
            (inclusive of all taxes)
        </div>
    </div>


    <!-------------For desktop----------------->
    <script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}
</script>
    <!--Details of the products-->

    <div class="detailsed">




        <div class="sizing">

                <form class="boxed" method="post" >
          <?php
            if($product_sizing=='Top Wear')
            {

              ?>

                <p class="quantity">Size</p>
                  <input type="radio" id="S" name="size" value="S">
                  <label for="S">S</label>
                  <input type="radio" id="M" name="size" value="M">
                  <label for="M">M </label>
                  <input type="radio" id="L" name="size" value="L">
                  <label for="L">L</label>
                  <input type="radio" id="XL" name="size" value="XL">
                  <label for="XL">XL </label>
                  <input type="radio" id="XXL" name="size" value="XXL">
                  <label for="XXL">XXL </label>


                 <p class="quantity">Quantity</p>
                  <select name="qty">
                    <option disabled value="Quantity">Quantity</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>


              <?php
            }

            if($product_sizing=='Footwear')
            {
              ?>

                 <p class="quantity">Size</p>
                  <input type="radio" id="6" name="size" value="6">
                  <label for="6">6</label>
                  <input type="radio" id="7" name="size" value="7">
                  <label for="7">7 </label>
                  <input type="radio" id="8" name="size" value="8">
                  <label for="8">8</label>
                  <input type="radio" id="9" name="size" value="9">
                  <label for="9">9 </label>
                  <input type="radio" id="10" name="size" value="10">
                  <label for="10">10 </label>
                  <input type="radio" id="11" name="size" value="11">
                  <label for="11">11 </label>

                  <p class="quantity">Quantity</p>
                  <select name="qty">
                    <option disabled value="Quantity">Quantity</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>

              <?php
            }

            if($product_sizing=='Bottom Wear')
            {
              ?>

                <p class="quantity">size</p>
                  <input type="radio" id="30" name="size" value="30">
                  <label for="30">30</label>

                  <input type="radio" id="32" name="size" value="32">
                  <label for="32">32 </label>

                  <input type="radio" id="34" name="size" value="34">
                  <label for="34">34</label>

                  <input type="radio" id="36" name="size" value="36">
                  <label for="36">36 </label>

                  <p class="quantity">Quantity</p>
                  <select name="qty">
                    <option disabled value="Quantity">Quantity</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>



              <?php
            }

          ;?>
        </div>
        <div class="descriptions" style="margin-bottom:60px;">

            <p id="p">Product Descriptions</p>
            <div class="tinymce">
            <div class="desc_table">
              <a>Product Code</a>
              <a id="desc_right"><?php echo $product_code;?></a>
            </div>
            <div class="desc_table">
              <a>Color </a>
              <?php echo "<a id='desc_right' style='color:".$product_color.";'>
              <i style='font-size:18px;font-weight:bold;' class='fas fa-circle'></i></a>";?>
            </div>

            <div class="desc_table">
              <a>Fabric</a>
              <a id="desc_right"><?php echo $product_fabric;?></a>
            </div>
            <div class="desc_table">
              <a>Pattern</a>
              <a id="desc_right"><?php echo $product_pattern;?></a>
            </div>
            <div class="desc_table">
              <a>Category</a>
              <a id="desc_right"><?php echo $product_cat;?></a>
            </div>
            <div class="desc_table">
              <a>Care Info</a>
              <a id="desc_right"><?php echo $product_desc;?></a>
            </div>
            <div class="desc_table">
              <a>Brand</a>
              <a id="desc_right"><?php echo $product_brand;?></a>
            </div>
            <div class="desc_table">
              <a>Brand Info</a>
              <a id="desc_right"><?php echo $product_brand_info;?></a>
            </div>
          </div>
          <div class="advanced">
            <button class="btn_desc"><i class="fa fa-money" aria-hidden="true" style="font-size:18px; color:#fe5906;"></i>&nbsp;&nbsp;100% Refund Guaranteed</button>
            <button class="btn_desc"><i class="fas fa-shield-alt" style="font-size:18px; color:deepskyblue;"></i>&nbsp;&nbsp;Tuanish Validated</button>
            <button class="btn_desc"><i class='fas fa-shipping-fast' style="font-size:18px; color:green;"></i>&nbsp;&nbsp;Free Shipping</button>
          </div>
          <div class="seller">
            <a href="indexs.php?seller=<?php echo $seller_shop;?>" style="background:green;opacity:0.8;"><i class="fas fa-tshirt"></i>&nbsp;Sell By</a>
            <a href="" style="background:green;"><i class="fab fa-whatsapp"></i>&nbsp;Share</a>
          </div>
        </div>


          <!--================Related Products===================-->
          <div class="shop">
            <p id="related" style="font-size:25px;text-shadow: 2px 2px 4px #000000;">Related Products</p>
          <?php
           $query="SELECT * FROM products WHERE cat_title=:cat_title  order by rand() LIMIT 0,6";
           $run=$pdo->prepare($query);
           $run->bindParam(':cat_title',$product_cat,PDO::PARAM_STR);
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
          </div>

         ";

       ?>

                <!--================You may like====================-->
                <div class="shop">
                  <p id="related" style="font-size:25px;text-shadow: 2px 2px 4px #000000;">Products You May Like</p>
                <?php
                 $query="SELECT * FROM products  order by rand() LIMIT 0,6";
                 $run=$pdo->prepare($query);
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
                </div>

               ";
?>
<!--=============================================================-->
        </div>


        <?php
              if(isset($_POST['pin-sub']))
              {
                $pincode_new=$_POST['pincode'];
                $query="UPDATE customers SET customer_pincode=:customer_pincode WHERE customer_email=:customer_email";
                $run=$pdo->prepare($query);
                $run->bindParam(':customer_pincode',$pincode_new,PDO::PARAM_INT);
                $run->bindParam(':customer_email',$customer_email,PDO::PARAM_STR);
                $run->execute();

                if($run)
                {
                  echo "<script>window.open('indexs.php?details&product_id=$product_id','_self')</script>";
                }

              }

            ?>

            <div class="footer">
            <input type="submit" class="buy" class="buy" name="buynow" value="Buy Now">
            <input type="submit" class="add" name="addproduct" value="Add to Cart">
            </div>
        </div>
        </form>
      </div>
    </div>

<?php



     if(isset($_POST['addproduct']))
      {
        if(!isset($_SESSION['customer_email']))
        {
          echo  "<script>window.open('indexs.php?carts','_self')</script>";
          exit();
        }
        else
        {


        $product_id=$_GET['product_id'];
        $query="SELECT * FROM products WHERE product_id=:product_id";
        $run=$pdo->prepare($query);
        $run->bindParam(':product_id',$product_id,PDO::PARAM_INT);
        $run->execute();
        $row=$run->fetchAll(PDO::FETCH_ASSOC);


        foreach($row as $result)
        {
            $product_code=$result['product_code'];

            $ip_add=getRealIpUser();
            $product_size=$_POST['size'];
            $product_quantity=$_POST['qty'];


            $query_check="SELECT * FROM cart WHERE product_id=:product_id AND customer_email=:customer_email";
            $run_check=$pdo->prepare($query_check);
            $run_check->bindParam(':product_id',$product_id,PDO::PARAM_STR);
            $run_check->bindParam(':customer_email',$customer_email,PDO::PARAM_STR);
            $run_check->execute();
            $check=$run_check->rowCount();

            if($check==true)
            {
                echo "<script>alert('Product exist in cart')</script>";


            }
            else
            {
                  $query="INSERT INTO cart(product_id,customer_email,ip_add,qty,size,product_code) VALUES(:product_id,:customer_email,:ip_add,:qty,:size,:product_code)";
                  $run=$pdo->prepare($query);
                  $run->bindParam(':product_id',$product_id,PDO::PARAM_INT);
                  $run->bindParam(':customer_email',$customer_email,PDO::PARAM_STR);
                  $run->bindParam(':ip_add',$ip_add,PDO::PARAM_STR);
                  $run->bindParam(':qty',$product_quantity,PDO::PARAM_INT);
                  $run->bindParam(':size',$product_size,PDO::PARAM_STR);
                  $run->bindParam(':product_code',$product_code,PDO::PARAM_STR);
                  $run->execute();
                  if($run)
                  {
                    echo "<script>alert('Product added to the cart');
                          </script>";

                  }
                  else
                  {
                    echo "<script>alert('Failed')</script>";
                  }

            }

        }
      }
      }

?>
<?php

if(isset($_POST['buynow']))
{

  $product_id=$_GET['product_id'];
  $query="SELECT * FROM products WHERE product_id=:product_id";
  $run=$pdo->prepare($query);
  $run->bindParam(':product_id',$product_id,PDO::PARAM_INT);
  $run->execute();
  $row=$run->fetchAll(PDO::FETCH_ASSOC);


  foreach($row as $result)
  {
      $product_code=$result['product_code'];

      $ip_add=getRealIpUser();
      $product_size=$_POST['size'];
      $product_quantity=$_POST['qty'];


      $query_check="SELECT * FROM cart WHERE product_id=:product_id AND customer_email=:customer_email";
      $run_check=$pdo->prepare($query_check);
      $run_check->bindParam(':product_id',$product_id,PDO::PARAM_STR);
      $run_check->bindParam(':customer_email',$customer_email,PDO::PARAM_STR);
      $run_check->execute();
      $check=$run_check->rowCount();

      if($check==true)
      {

          echo "<script>window.open('indexs.php?carts','_self')</script>";

      }
      else
      {
        $query="INSERT INTO cart(product_id,customer_email,ip_add,qty,size,product_code) VALUES(:product_id,:customer_email,:ip_add,:qty,:size,:product_code)";
          $run=$pdo->prepare($query);
          $run->bindParam(':product_id',$product_id,PDO::PARAM_INT);
          $run->bindParam(':customer_email',$customer_email,PDO::PARAM_STR);
          $run->bindParam(':ip_add',$ip_add,PDO::PARAM_STR);
          $run->bindParam(':qty',$product_quantity,PDO::PARAM_INT);
          $run->bindParam(':size',$product_size,PDO::PARAM_STR);
          $run->bindParam(':product_code',$product_code,PDO::PARAM_STR);
          $run->execute();

            if($run)
            {
              echo "<script>window.open('indexs.php?carts','_self')</script>";

            }
            else
            {
              echo "<script>alert('Failed')</script>";
            }

      }

  }
}
?>






<!--Javascript code for slider-->


            <!--You may like-->


            <!--You may like-->


</body>
</html>
