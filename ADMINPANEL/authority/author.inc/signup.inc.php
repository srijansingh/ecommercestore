<?php
ob_start();

require '../../configure/dbh.config.php';


if(isset($_POST['subadmin']))
{
    $admin_name=$_POST['admin_name'];
    $admin_email=$_POST['admin_email'];
    $admin_password=$_POST['password'];

    $admin_image="user/user.png";
    $admin_country="INDIA";
    $admin_about="Edit your work";
    $admin_contact="9935000000";
    $admin_job="Edit your Job";

    $sqli="SELECT * FROM admins WHERE admin_email=:admin_email";
    $check=$pdo->prepare($sqli);
    $check->bindParam(":admin_email",$admin_email,PDO::PARAM_STR);
    $check->execute();
    $count_check=$check->rowCount();
    if($count_check==true)
    {
        header("Location: index.php?insert_user&useralreadyexist");
        exit();
    }
    else
    {
        $sql="INSERT INTO admins(admin_name,admin_email,admin_pass,admin_image,admin_country,admin_about,admin_contact,admin_job) VALUES(:admin_name,:admin_email,:admin_pass,:admin_image,:admin_country,:admin_about,:admin_contact,:admin_job)";
        $stmt=$pdo->prepare($sql);

        $hash_pwd=password_hash($admin_password,PASSWORD_DEFAULT);

        $stmt->bindParam(":admin_name",$admin_name,PDO::PARAM_STR);
        $stmt->bindParam(":admin_email",$admin_email,PDO::PARAM_STR);
        $stmt->bindParam(":admin_pass",$hash_pwd,PDO::PARAM_STR);
        $stmt->bindParam(":admin_image",$admin_image,PDO::PARAM_STR);
        $stmt->bindParam(":admin_country",$admin_country,PDO::PARAM_STR);
        $stmt->bindParam(":admin_about",$admin_about,PDO::PARAM_STR);
        $stmt->bindParam(":admin_contact",$admin_contact,PDO::PARAM_INT);
        $stmt->bindParam(":admin_job",$admin_job,PDO::PARAM_STR);

        $stmt->execute();
        if($stmt)
        {
            echo "Inserted";
        }

    }
}
else
{
    header("Location: ");
    exit();
}
ob_end_flush();
