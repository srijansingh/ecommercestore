<?php
    if(!isset($_SESSION['customer_email']))
    {
        header("Location: indexs.php?login");
    }
    else
    {
        $customer_email=$_SESSION['customer_email'];
        $query="SELECT * FROM customers WHERE customer_email='$customer_email'";
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <link rel="stylesheet" href="STORE\css\updateacc.css">
    <title></title>
    <script type="text/javascript">
    function next(){window.history.forward()}
function back(){window.history.back()}
function go(){window.history.go(1)}
    </script>
</head>
<body>

<div class="login-box">

        <div class="img_name">
           <div class="image_profile">
            <img src="<?php echo $customer_image; ?>" alt="your image">
           </div>
           <div class="name_profile">
               <span class="names"><?php echo $customer_name; ?></span><br><br>

           </div>


        </div>




                <div class="form-data">
                    <?php
                      if($_GET['emptyfieldserror']=='error')
                      {
                        echo "<p style='color:red'>*Fields are seems to be empty</p>";
                      }
                      if($_GET['invalidpincode']=='error')
                      {
                        echo "<p style='color:red'>*Pincode Invalid</p>";
                      }
                      if($_GET['invalidcontact']=='error')
                      {
                        echo "<p style='color:red'>*Contact Invalid</p>";
                      }

                    ?>
                    <form method="post">

                    <label>Email</label>
                    <input type="email" name="email" style="background:#fff;cursor:not-allowed" value="<?php echo $customer_email;?>" placeholder="Your Email" disabled>

                    <label>Mobile Number</label>
                    <input type="number" name="customer_contact" style="background:#fff;" value="<?php echo $customer_contact;?>" placeholder="Your Mobile Number" id="m_num" disabled>
                    <label>Address</label>
                    <input type="text" name="customer_address" value="<?php echo $customer_address;?>"  placeholder="House number, flat number" id="add">

                    <input type="text" name="customer_city" value="<?php echo $customer_city;?>" placeholder="City and State" id="city">

                    <input type="number" name="customer_pincode" value="<?php echo $customer_pincode;?>" placeholder="Pincode" id="pin">

                    <input type="submit" name="update_acc" value="Update">
                    </form>
                </div>


</div>



                <?php
                    if(isset($_POST['update_acc']))
                    {
                        $customer_newcontact=$_POST['customer_contact'];
                        $customer_newaddress=$_POST['customer_address'];
                        $customer_newcity=$_POST['customer_city'];
                        $customer_newpincode=$_POST['customer_pincode'];

                        if(empty($customer_newcontact) || empty($customer_newaddress) || empty($customer_newcity) || empty($customer_newpincode))
                        {

                            header("Location: indexs.php?acc_setting&emptyfieldserror=error");
                            exit();

                        }
                        else if(strlen($customer_newpincode)!=6)
                        {
                            header("Location: indexs.php?acc_setting&invalidpincode=error");
                            exit();
                        }
                        else if(strlen($customer_newcontact)<10)
                        {
                            header("Location: indexs.php?acc_setting&invalidcontact=error");
                            exit();
                        }
                        else
                        {

                            $update_query="UPDATE customers SET customer_address=:customer_address,customer_city=:customer_city,customer_pincode=:customer_pincode WHERE customer_email=:customer_email";
                            $run_update=$pdo->prepare($update_query);

                            $run_update->bindParam(':customer_address',$customer_newaddress,PDO::PARAM_STR);
                            $run_update->bindParam(':customer_city',$customer_newcity,PDO::PARAM_STR);
                            $run_update->bindParam(':customer_pincode',$customer_newpincode,PDO::PARAM_INT);
                            $run_update->bindParam(':customer_email',$customer_email,PDO::PARAM_STR);
                            $run_update->execute();

                            if($run_update)
                            {

                                echo "<script>window.open('indexs.php?myaccount=updated','_self')</script>";
                            }
                        }
                    }

                ?>

                <div class="head_back">
                   <a onclick="back()"><i class="fas fa-arrow-left"></i></a>
                </div>
</body>
</html>
<?php

    }
?>
