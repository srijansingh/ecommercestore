<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
<link rel="stylesheet" href="STORE\css\payment.css">
<title> Title </title>
<script type="text/javascript">
function next(){window.history.forward()}
function back(){window.history.back()}
function go(){window.history.go(1)}
</script>
</head>

<body>
   <form action="indexs.php?checkout" method="post">
    <div class="payment_container">
         <section>
            <div class="pro_img">
              <p>Products</p>

<?php

    if(!isset($_GET['payment']))
    {
        header("Location: indexs.php?error=payment");
        exit();
    }
    else
    {
            $customer_email=$_SESSION['customer_email'];
            $query_am="SELECT * FROM cart WHERE customer_email=:customer_email";
            $run_am=$pdo->prepare($query_am);
            $run_am->bindParam(':customer_email',$customer_email,PDO::PARAM_STR);
            $run_am->execute();
            $total_product_in_cart=$run_am->rowCount();
            $row=$run_am->fetchAll(PDO::FETCH_ASSOC);
            echo "<span style='font-size:12px;padding:3px 0px'>Items<b>(".$total_product_in_cart.")</b></span>";
            $grand_total=0;
            if($total_product_in_cart!=0)
            {
                foreach($row as $result_am)
                {

                    $product_code=$result_am['product_code'];
                    $product_qty=$result_am['qty'];
                    $product_size=$result_am['size'];
                    $queries="SELECT * FROM products WHERE product_code=:product_code";
                    $runs=$pdo->prepare($queries);
                    $runs->bindParam(':product_code',$product_code,PDO::PARAM_STR);
                    $runs->execute();
                    $rows=$runs->fetchAll(PDO::FETCH_ASSOC);
                    foreach($rows as $results)
                    {
                        $seller_shop=$result['product_seller'];
                        $product_title=$results['product_title'];
                        $product_price = $results['product_price'];

                        $subtotal=$results['product_price']*$product_qty;
                        $grand_total += $subtotal;

                        $query_pic="SELECT * FROM products_image WHERE product_code=:product_code LIMIT 1";
                        $run_pic=$pdo->prepare($query_pic);
                        $run_pic->bindParam(':product_code',$product_code,PDO::PARAM_STR);
                        $run_pic->execute();
                        $row=$run_pic->fetchAll(PDO::FETCH_ASSOC);
                        foreach($row as $img)
                        {
                            echo "

                                <div class='individual'>
                                    <div class='ind_image'>

                     <img src='data:image/jpeg;base64,".base64_encode($img['product_img'])."' >
                                    </div>
                                    <div class='pro_des'>
                                        <span>".$product_title."</span><br>
                                        <span><b> &#x20B9 ".$product_price."</b></span>
                                    </div>
                                </div>

                            ";
                        }

                    }
                }


?>

<?php


$customer_email=$_SESSION['customer_email'];

$query="SELECT * FROM customers WHERE customer_email=:customer_email";
$run=$pdo->prepare($query);
$run->bindParam(':customer_email',$customer_email,PDO::PARAM_STR);
$run->execute();
$row=$run->fetchAll(PDO::FETCH_ASSOC);
foreach($row as $result)
{


$customer_name=$result['customer_fname']." ".$result['customer_lname'];
$customer_contact=$result['customer_contact'];
$customer_country=$result['customer_country'];

$customer_city=$result['customer_city'];
$customer_address=$result['customer_address'];
$customer_pincode=$result['customer_pincode'];
$customer_gender=$result['customer_gender'];
$customer_image=$result['customer_image'];
}
?>








        </div>

        <div class="pro_img">
            <p>Final Amount</p>
           <p style="font-weight:normal;border:1px solid #e6e6e6;border-radius:5px 10px;padding:8px 6px">Payable Amount <a style="position:relative;float:right;font-weight:bold">&#x20B9 <?php echo $grand_total;?> </a></p>
        </div>
        </section>
        <section>
        <div class="pro_img">
            <p>Delivery Address<a href='indexs.php?acc_setting=payment' style='position: relative;color:#00bfff;float:right;font-size:15px;'>Change</a></p>
            <div class="del_options">
                <p><?php echo $customer_name ;?></p><br/>
               <input type="radio"  value="
                <?php
                echo $customer_address.", ".$customer_city.", ".$customer_pincode.",".$customer_country;

                ?>" checked name="delivery_address">
                <?php
                echo $customer_address."</br>".$customer_city."</br>".$customer_pincode."</br>".$customer_country;

                ?>
                
                
            </div>
        </div>

        <div class="pro_img">
           <p>Choose Payment Option</p>
            <div class="options">
                <span>Cash On Delivery</span><span class="right"><input type="radio" name="payment" value="Pay on Cash" checked></span>
            </div>
        </div>





    <div class="confirm_order">
        <div class="confirm_order-inc">
            <div style="font-size:20px;padding:8px;color:deepskyblue">One click away to</div>
            <div>
                <button  name="confirm_order" >Confirm Order</button>
            </div>
        </div>

    </div>
    </section>
    </div>
    </form>
    <?php
            }
            else{
                header("Location: index.php");
                exit();
            }
        }
/*===============================================================================================================*/
?>
<div class="head_back">
  <a onclick="back()"><i class="fas fa-arrow-left"></i></a>
</div>

</body>
</html>
