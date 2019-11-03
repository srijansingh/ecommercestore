<?php
  session_start();

    require '../../CONFIGURE/config.inc/dbh.config.php';

    if(isset($_POST['logauth']))
    {
       $seller_uid=$_POST['seller_uid'];
       $seller_pass=$_POST['seller_password'];
       $hash_pwd=password_hash($admin_pass,PASSWORD_DEFAULT);
       $sql="SELECT * FROM seller WHERE seller_email=:seller_email or seller_username=:seller_username";
       $stmt=$pdo->prepare($sql);
       if($stmt==true)
       {
          $stmt->bindParam(":seller_email",$seller_uid,PDO::PARAM_STR);
          $stmt->bindParam(":seller_username",$seller_uid,PDO::PARAM_STR);
          $stmt->execute();
          if($row=$stmt->fetch(PDO::FETCH_ASSOC))
          {
            $pwdCheck=password_verify($seller_pass,$row['seller_password']);
            if($pwdCheck==false)
            {
               header("Location: ../login.sell.php?nouser");
               exit();

            }
            else if($pwdCheck==true)
            {

               $_SESSION['seller_email']=$row['seller_email'];
               $_SESSION['seller_username']=$row['seller_username'];
               header("Location: ../../index.php?dashboard");
               exit();
            }
         }
      }
   }
