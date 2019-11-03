<?php
$head='<a style="color:blue;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Products</a>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
	<link rel="stylesheet" href="css/view.sell.css">
	<title> Tuanish </title>
	<script type="text/javascript">
	  function fun()
	  {
	    return confirm('Are you sure you want to delete this product');
	     ;
	  }
	</script>
</head>
<body>
   <div class="shop">
   <?php
    $seller_email=$_SESSION['seller_email'];
    $query="SELECT * FROM products WHERE product_seller=:product_seller";
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

            $querys="SELECT * FROM products_image WHERE product_code=:product_code  limit 1";
            $runs=$pdo->prepare($querys);
            $runs->bindParam(':product_code',$product_code,PDO::PARAM_STR);
            $runs->execute();
            $row=$runs->fetchAll(PDO::FETCH_ASSOC);
            $total_img=$runs->rowCount();

            foreach($row as $result_img)
            {

            echo "
               <section>

               <div class='img'><a href='index.php?details&product_code=$product_code&p=$product_title'>
               <img src='data:image/jpeg;base64,".base64_encode($result_img['product_img'])."'></a>
           </div>
            <div class='ptitle'><a href='index.php?details&product_code=$product_code&p=$product_title'>Code  
              ". $product_code."</a>
            </div>
            <div class='pname'><a href='index.php?details&product_code=$product_code&p=$product_title'>
              ".$product_title."</a>
            </div>
            <div class='price'><a href='index.php?details&product_code=$product_code&p=$product_title'>
              <b>&#x20B9 ".$product_price."</b><del class='del'><i>".$original."</i></del><font class='discount'>".$product_discount."% off</font></a>
            </div>
            <a href='index.php?delete&product_code=$product_code' onclick='return fun()'><div class='delete' style='position:absolute;top:10px;right:10px;background:black;border-radius:50%;padding:7px;font-size:15px;color:white;opacity:0.4;float:right;'><i class='fa fa-trash'></i></div></a>
            </section>
                ";
            }
        }
    }

  echo "
	 </div>
   </div>

  ";

?>




 </body>
</html>
