<?php


    if(isset($_POST['search']))
    {
        $valueToSearch=mysqli_real_escape_string($conn,$_POST['valueSearch']);
        $query="SELECT * FROM `products` WHERE CONCAT(`product_code`, `product_id`, `product_cat_title`, `cat_title`, `product_sizing`, `date`, `product_title`, `original_price`, `product_price`, `product_discount`, `product_keywords`, `product_desc`, `product_color`, `product_pattern`, `product_brand`, `product_brand_info`, `product_fabric`) LIKE '%".$valueToSearch."%'";
        $run=filterTable($query);
        $count=mysqli_num_rows($run);
    }
    else {
      ?>
      <div class="noitems">
				<div class="icon">
					<i class="fas fa-search" id="icons"></i></a>

				</div>
				<div class="items" style="color:#a6a6a6;">
					Search your product here
				</div>
				<div class="go">
					<a href="indexs.php?shop">View All Products</a>
				</div>

			</div>
      <?php


    }


    function filterTable($query)
    {
        require 'CONFIGURE\config.inc\dbh.config.php';
        $runs=mysqli_query($conn,$query);
        return $runs;
    }
    ?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="STORE\css\search.css">
    <link rel="stylesheet" href="STORE\css\shop.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" >
    <script type="text/javascript">
  	function next(){window.history.forward()}
  function back(){window.history.back()}
  function go(){window.history.go(1)}
  	</script>
    <title>Document</title>
    <style>

    </style>
</head>
<body>



    <div class="shop">
      <?php
      if(isset($_POST['search']))
      {
        echo '
      <div class="result" style="color:#333333;position:relative;background:#fff;padding:5px 3px " >
        <p>Showing result for <b> '.$_POST["valueSearch"].'</b></p>';

      ?>
      </div>
    <?php


     echo  '

     <div class="product">';
     if($count>0){
        while($result=mysqli_fetch_assoc($run))
        {
            $product_id=$result['product_id'];
            $product_title=$result['product_title'];
            $product_cat=$result['cat_title'];

            $product_code=$result['product_code'];

            $product_cat=$result['cat_title'];
            $product_price=$result['product_price'];
            $product_discount=$result['product_discount'];
            $original=$result['original_price'];

            $querys="SELECT * FROM products_image WHERE product_code='$product_code' order by rand() limit 1";
            $runs=mysqli_query($conn,$querys) or die(mysqli_error($conn));
            $total_img=mysqli_num_rows($runs);

            while($result_img=mysqli_fetch_assoc($runs))
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
      else{
        echo '
        <div class="noitems">
  				<div class="icon">
  					<i class="fas fa-search" id="icons"></i></a>

  				</div>
  				<div class="items" style="color:#a6a6a6;">
  					No match found
  				</div>
  				<div class="go">
  					<a href="indexs.php?shop">View All Products</a>
  				</div>

  			</div>
        ';
      }



  echo "    </div>
   </div>

  ";
}

 ?>

    <div class="search_box">

        <form action="indexs.php?search" method="post">
          <a onclick="back()"><i class="fas fa-arrow-left"></i></a>
           <input type="search" name="valueSearch" placeholder="What are you searching for?">
            <button name="search"><i class="fa fa-search"></i></button>
        </form>
    </div>
</body>
</html>
