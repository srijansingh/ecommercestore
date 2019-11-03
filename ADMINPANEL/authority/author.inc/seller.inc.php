<?php
ob_start();
require 'configure/dbh.config.php';
if(!isset($_SESSION['admin_email']))
{
    header("Location: login.author.php");
    exit();
}

if(isset($_POST['subseller']))
{
    $seller_fname=$_POST['seller_fname'];
    $seller_lname=$_POST['seller_lname'];
    $seller_shop=$_POST['shop_name'];
    $seller_email=$_POST['seller_email'];
    $seller_password=$_POST['password'];
    $seller_city=$_POST['seller_city'];
    $seller_contact=$_POST['seller_contact'];
    $seller_address=$_POST['seller_address'];
    $seller_link=$_POST['seller_link'];
    $seller_pincode=$_POST['seller_pincode'];

    $seller_image="user/user.png";

    $newgid=sprintf('%05d', rand(0,999999));
    $seller_username=strtolower($seller_fname."".$newgid);

    $file=$_FILES['file'];
    $tmp=$_FILES['file']['tmp_name'];
		$folder="PHOTO/".$file['name'];


			move_uploaded_file($file['tmp_name'], "../PHOTO/".$file['name']);


    $file=$_FILES['file']['name'];
		$folders="photo/".$file;
    $sqli="SELECT * FROM seller WHERE seller_email=:seller_email";
    $check=$pdo->prepare($sqli);
    $check->bindParam(":seller_email",$seller_email,PDO::PARAM_STR);
    $check->execute();
    $count_check=$check->rowCount();
    if($count_check==true)
    {
        header("Location: index.php?insert_seller&useralreadyexist");
        exit();
    }
    else
    {
        $sql="INSERT INTO seller(seller_fname,seller_lname,shop_name,seller_email,seller_username,seller_password,seller_contact,seller_city,seller_address,seller_pincode,seller_link,seller_image,seller_cover) VALUES(:seller_fname,:seller_lname,:shop_name,:seller_email,:seller_username,:seller_password,:seller_contact,:seller_city,:seller_address,:seller_pincode,:seller_link,:seller_image,:seller_cover)";
        $stmt=$pdo->prepare($sql);

        $hash_pwd=password_hash($seller_password,PASSWORD_DEFAULT);

        $stmt->bindParam(":seller_fname",$seller_fname,PDO::PARAM_STR);
        $stmt->bindParam(":seller_lname",$seller_lname,PDO::PARAM_STR);
        $stmt->bindParam(":shop_name",$seller_shop,PDO::PARAM_STR);
        $stmt->bindParam(":seller_email",$seller_email,PDO::PARAM_STR);
        $stmt->bindParam(":seller_username",$seller_username,PDO::PARAM_STR);
        $stmt->bindParam(":seller_password",$hash_pwd,PDO::PARAM_STR);
        $stmt->bindParam(":seller_contact",$seller_contact,PDO::PARAM_INT);
        $stmt->bindParam(":seller_city",$seller_city,PDO::PARAM_STR);
        $stmt->bindParam(":seller_address",$seller_address,PDO::PARAM_STR);
        $stmt->bindParam(":seller_pincode",$seller_pincode,PDO::PARAM_INT);
        $stmt->bindParam(":seller_link",$seller_link,PDO::PARAM_STR);
        $stmt->bindParam(":seller_image",$seller_image,PDO::PARAM_STR);
        $stmt->bindParam(":seller_cover",$folders,PDO::PARAM_STR);


        $stmt->execute();
        if($stmt)
        {
          header("Location: index.php?dashboard");
          exit();
        }

    }
}
else
{
    header("Location: ");
    exit();
}
ob_end_flush();
