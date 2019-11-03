
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
<link rel="stylesheet" href="STORE/css/shop.css">
	<title> Tuanish </title>
	<script type="text/javascript">
	function next(){window.history.forward()}
function back(){window.history.back()}
function go(){window.history.go(1)}
	</script>
</head>
<body>
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

<div class="head_back">
  <a onclick="back()"><i class="fas fa-arrow-left"></i></a>
</div>


 </body>
</html>
