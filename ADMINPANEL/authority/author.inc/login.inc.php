<?php
ob_start();
    session_start();
    require '../../configure/dbh.config.php';

    if(isset($_POST['logauth']))
    {
       $admin_email=$_POST['email'];
       $admin_pass=$_POST['password'];
       $hash_pwd=password_hash($admin_pass,PASSWORD_DEFAULT);
       $sql="SELECT * FROM admins WHERE admin_email=:admin_email";
       $stmt=$pdo->prepare($sql);
       if($stmt==true)
       {
          $stmt->bindParam(":admin_email",$admin_email,PDO::PARAM_STR);
          $stmt->execute();
          if($row=$stmt->fetch(PDO::FETCH_ASSOC))
          {
            $pwdCheck=password_verify($admin_pass,$row['admin_pass']);
            if($pwdCheck==false)
            {
               header("Location: ../login.author.php?nouser");
               exit();

            }
            else if($pwdCheck==true)
            {

               $_SESSION['admin_email']=$row['admin_email'];
               header("Location: ../../index.php?dashboard");
               exit();
            }
         }
      }
   }
ob_end_flush();