<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="STORE\css\myaccount.css">
    <title></title>
</head>
<body>


   <?php
    if(!isset($_SESSION['customer_email']))
    {
        ?>
        <div class="noitems">
  				<div class="icon">
  					<i class="fas fa-sign-out-alt" id="icons"></i></a>

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

    <div class="account">
        <div class="img_name">
           <div class="image_profile">
            <img src="<?php echo $customer_image; ?>" alt="icon">
           </div>
           <div class="name_profile">
               <span class="names"><?php echo $customer_name; ?></span><br><br>
           </div>
           <div class="name_profile">
               <span class="name_con"><?php echo $customer_contact; ?></span><br>
           </div>
           <div class="name_profile">
               <span class="name_con"><?php echo $customer_email; ?></span><br>
           </div>
        </div>

        <div class="myaccount">
          <?php
          if($_GET['myaccount']=='updated')
          {
            echo "<p style='color:green;text-align:center'>*Contact Updated</p>";
          }
          ?>
         <div class="address">
            <div class="myaddhead">My Orders</div>
            <div class="myadddesc">
              <?php
              $customer_email=$_SESSION['customer_email'];

          		$query="SELECT * FROM pending_orders WHERE customer_email=:customer_email";
          		$run_query=$pdo->prepare($query);
              $run_query->bindParam(':customer_email',$customer_email,PDO::PARAM_STR);
              $run_query->execute();


          		$total_orders=$run_query->rowCount();
              if($total_orders>0)
              {
              echo 'You have '.$total_orders.' orders in total';
              }
              else
              {
                echo 'You have no orders';
              }
               ?>
            </div>
            <a href="indexs.php?myorders"><div class="myaddbtn2">View Order Details Here</div></a>

        </div>

        <div class="address">
            <div class="myaddhead">My Address</div>
            <div class="myadddesc">

                <?php echo $customer_address.",".$customer_city ;?><br>
                <?php echo $customer_pincode ;?>
            </div>
            <a href="indexs.php?acc_setting=myaccount"><div class="myaddbtn2">View Shipping Address</div></a>
        </div>
        <div class="address" style="">

            <a href="indexs.php?acc_setting=myaccount"><div class="myaddbtn2" style="margin:0px 0px;border-radius:5px 10px 0 0"><i class="fa fa-gear"></i>&nbsp;Account Setting</div></a>
            <a href="indexs.php?logout"><div class="myaddbtn2" style="margin:0px 0px;border-radius:0px 0px 5px 10px"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout from Browser</div></a>

        </div>
        </div>
    </div>
</body>
</html>
<?php
    }
?>
