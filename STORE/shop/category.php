<?php
session_start();

?>
   <!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
    <link rel="stylesheet" href="STORE\css\shop.css">
   </head>
   <body>
   <div class="shop">
   <?php
   if(isset($_GET['c']))
   {
      $product_cat=$_GET['c'];
      $query="SELECT * FROM products WHERE cat_title=:cat_title";
      $run=$pdo->prepare($query);
      $run->bindParam(':cat_title',$product_cat,PDO::PARAM_STR);
      $run->execute();
      $total=$run->rowCount();
      $row=$run->fetchAll(PDO::FETCH_ASSOC);
          if($total!=0)
          {

              ?>
          <div class="product">


           <?php

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

            $querys="SELECT * FROM products_image WHERE product_code='$product_code' order by rand() limit 2";
            $runs=$pdo->prepare($querys);
            $runs->bindParam(':product_code',$product_code,PDO::PARAM_STR);
            $runs->execute();
            $total_img=$runs->rowCount();
            $row=$runs->fetchAll(PDO::FETCH_ASSOC);
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
          else
          {
            echo "<div class='noitems'>
                  <h1>No product in this category</h1>
                </div>";
          }




      ?>

       </div>

        <?php

  }

?>
<div>
  <?php require 'STORE/header/media.php'; ?>
</div>

       </div>


       </body>

       </html>

  <?php



?>
