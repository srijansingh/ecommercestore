<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">


<title>Tuanish</title>


	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link rel="stylesheet" href="STORE\css\cart.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body style="background:#fff">

<?php


   if(!isset($_SESSION['customer_email']))
   {
      ?>
			<div class="noitems">
				<div class="icon">
					<i class="fas fa-sign-out-alt" style="color:#e6e6e6"id="icons"></i></a>

				</div>
				<div class="items" style="color:#a6a6a6;">
					Oops! not logged in.
				</div>
				<div class="go">
					<a href="indexs.php?login">Login Now</a>
				</div>

			</div>
        <?php
   }
else
{
   $customers_email=$_SESSION['customer_email'];
?>





<?php


		$query="SELECT * FROM cart WHERE customer_email=:customer_email";
		$run=$pdo->prepare($query);
    $run->bindParam(':customer_email',$customers_email,PDO::PARAM_STR);
    $run->execute();
		$total_item=$run->rowCount();
    $row=$run->fetchAll(PDO::FETCH_ASSOC);

		if($total_item!=0)
		{
			echo "<div class='main-shop'>
			<div class='cart'>";

			$total = 0;
			foreach($row as $result)
			{

				$product_id=$result['product_id'];
				$product_code=$result['product_code'];
				$product_size=$result['size'];
        $product_qty=$result['qty'];


				$query_product="SELECT * FROM products WHERE product_id=:product_id";
				$run_product=$pdo->prepare($query_product);
        $run_product->bindParam(':product_id',$product_id,PDO::PARAM_STR);
        $run_product->execute();
        $row_product=$run_product->fetchAll(PDO::FETCH_ASSOC);

				foreach($row_product as $result)
				{

					$product_code=$result['product_code'];
					$product_sizing=$result['product_sizing'];
					$product_title=$result['product_title'];
					$original_price=$result['original_price'];
					$product_price=$result['product_price'];
					$product_discount=$result['product_discount'];
					$product_color=$result['product_color'];
					$product_cat=$result['cat_title'];
					$product_code=$result['product_code'];
        			$subtotal=$result['product_price']*$product_qty;
          			$total += $subtotal;


					$origin += $original_price*$product_qty;

					$discount_cart = $origin-$total;

					$querys="SELECT  product_img FROM products_image WHERE product_code=:product_code limit 1";
					$runs=$pdo->prepare($querys);
          $runs->bindParam(':product_code',$product_code,PDO::PARAM_STR);
          $runs->execute();
					$total_img=$runs->rowCount();
          $row_img=$runs->fetchAll(PDO::FETCH_ASSOC);
					foreach($row_img as $result_img)
					{

					echo "
					<section class='cart_sec'>
						<div class='cartimg'>
						  <div class='imgs'>
							  <a href='indexs.php?details&product_id=$product_id&$product_title'>
		                      <img src='data:image/jpeg;base64,".base64_encode($result_img['product_img'])."'></a>
		                  </div>
						  <div class='product_details'>
						 	  <div class='tit_row' style='position:relative;display:inline-block;width:100%'>
							  <a class='p_tit'>$product_title</a> <a class='delete_cart' id='del_btn' href='indexs.php?remove&product_id=$result[product_id]'><i class='fa fa-trash-alt'></i></a>
							  </div>

							  <a class='p_pricing'>&#x20B9<b> $product_price</b> &nbsp;<del style='color:#a6a6a6'>$original_price</del>&nbsp;<font class='off'>$product_discount% off</font></a>
                              <a class='p_cat'>

								Size:<b>$product_size</b>
								&nbsp;&nbsp;&nbsp; Qty:<b> $product_qty</b><!--
								&nbsp;&nbsp;&nbsp;&nbsp;Color:&nbsp;<i style='color:".$product_color.";' class='fas fa-circle'></i>&nbsp;<i style='color:".$product_color.";' class='fas fa-circle'></i>&nbsp;<i style='color:".$product_color.";' class='fas fa-circle'></i>--></a><br>

		            	   </div>
	                    </div>
	                    <!--<div class='button'>
	                    	<a class='heart'><i class='fa fa-heart' id='heart'></i>&nbsp;Wishlist</a>
	                    	<a class='delete_cart' href='shop/delete_cart.php?product_id=$result[product_id]'><i class='fa fa-trash-alt'></i>&nbspRemove</a>
	                    </div>-->
                        </section>
	                ";
					}

				}


			}
			echo "</div>";

            if($total>1)
            {
            $grand_total=$total;
            $shipping='Free';
            }



	/*
==========================================
    Fixed checkout button
==========================================
*/ echo "<section><div class='price_description'>
                <span >Order Summary</span>
                    <div class='sub-total'>
                        <a>Total MRP (inc. all taxes)</a><a class='right'>&#x20B9 $origin</a>
                    </div>
                    <div class='sub-total'>
                        <a>Shipping Charges</a><a class='right' style='color:green;'>$shipping</a>
                    </div>
					<div class='sub-total'>
                        <a>Cart Discount</a><a class='right' style='color:green;'>- &#x20B9 $discount_cart</a>
                    </div>
                    <div class='sub-total' style='font-weight:bold;'>
                        <a>Payable amount</a><a class='right'> &#x20B9 $grand_total</a>
					</div>
					<p style='position:relative;color:green;'>You are saving <b>&#x20B9 $discount_cart</b> on this order.</p>
				</div>


				";
    echo "<div class='checkout'>
    		<div class='checkout-inc'>
            <div class='total_price'>
                Final amount <b> &#x20B9 $grand_total</b>
            </div>
            <div class='buy_btn'>
                <a href='indexs.php?payment'><button>Go to Checkout</button>
            </div>
         	</div>
         	</div>
         </section>
				</div>";
}
else {
	echo '
	<div class="noitems">
		<div class="icon">
			<i class="fa fa-shopping-cart" id="icons"></i></a>
		</div>
		<div class="items" style="color:#a6a6a6;">
			oops! I am empty.
		</div>
		<div class="go">
			<a href="index.php">Go to Catalog</a>
		</div>

	</div>

	';
}
	/*
==========================================
Check out done
==========================================
*/
?>

    </body>
</html>
<?php
}
?>
