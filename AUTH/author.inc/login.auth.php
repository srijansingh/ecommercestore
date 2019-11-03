<?php

if(isset($_POST['login']))
{
	require '../../CONFIGURE/config.inc/dbh.config.php';

	$email=$_POST['customers_email'];
	$password=$_POST['customers_password'];

	if(empty($email) || empty($password))
	{
		header("Location: ../../indexs.php?login&error=emptyfields");
		exit();
	}
	else
	{
		$sql="SELECT * FROM customers WHERE customer_contact=? OR  customer_email=?;";
		$stmt=mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql))
		{
			header("Location: ../../indexs.php?login&error=sqlerror");
			exit();
		}
		else
		{
			mysqli_stmt_bind_param($stmt, "ss", $email,$email);
			mysqli_stmt_execute($stmt);
			$result=mysqli_stmt_get_result($stmt);
			if($row=mysqli_fetch_assoc($result))
			{
				$pwdCheck=password_verify($password,$row['customer_password']);
				if($pwdCheck == false)
				{
					header("Location: ../../indexs.php?login&error=wrongpswd");
					exit();
				}
				else if($pwdCheck == true)
				{
					session_start();
					$_SESSION['customer_email']=$row['customer_email'];
					$_SESSION['customer_contact']=$row['customer_contact'];

					header("Location: ../../index.php?&login=success");
					exit();
				}
                else
                {
                   header("Location: ../../indexs.php?login&error=wrongpswd");
				exit();
                }
			}
			else
			{
				header("Location: ../../indexs.php?login&error=nouser");
				exit();
			}
		}
	}


}
else
{
	header("Location: ../login.php");
	exit();
}
