<?php
function getRealIpUser(){

    switch(true){

          case(!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
          case(!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
          case(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];

          default : return $_SERVER['REMOTE_ADDR'];

    }

}
?>
<?php

if(isset($_POST['signup']))

{
	require '../../CONFIGURE/config.inc/dbh.config.php';



	$fname=htmlentities(mysqli_real_escape_string($conn,$_POST['fname']));
    $lname=htmlentities(mysqli_real_escape_string($conn,$_POST['lname']));
    $gender=htmlentities(mysqli_real_escape_string($conn,$_POST['gender']));
    $email=htmlentities(mysqli_real_escape_string($conn,$_POST['email']));
	$customer_contact=htmlentities(mysqli_real_escape_string($conn,$_POST['contact']));
    $password=htmlentities(mysqli_real_escape_string($conn,$_POST['password']));
	$passwordRepeat=htmlentities(mysqli_real_escape_string($conn,$_POST['passwordRepeat']));

    if($gender=='Male')
    {
        $customer_image="user/boys.png";
    }
	else
    {
        $customer_image="user/girls.png";
    }

    $customer_country="India";
    $customer_state="Uttar Pradesh";
    $customer_city="Prayagraj";
    $customer_address="House number/Landmark";
    $customer_pincode="111111";
    $customer_ip=getRealIpUser();


	if(empty($fname) || empty($email) || empty($password) || empty($passwordRepeat))
	{
		header("Location: ../../indexs.php?signup&error=emptyfields&uid=".$fname."&email=".$email);
		exit();
	}
	else if(!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$fname) )
	{
		header("Location : ../../indexs.php?signup&error=invalidmailuid");
		exit();
	}
	else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
	{
		header("Location: ../../indexs.php?signup&error=invalidmail&uid=".$fname);
		exit();
	}
	else if($password != $passwordRepeat)
	{
		header("Location: ../../indexs.php?signup&error=passwordcheck&".$fname."&email".$email);
		exit();
	}

	$sql="SELECT customer_email FROM customers WHERE customer_email=?";
	$stmt=mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql))
	{
		header("Location: ../../indexs.php?signup&error=sqlierror");
		exit();
	}
	else
	{
		mysqli_stmt_bind_param($stmt,"s", $email);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		$resultCheck=mysqli_stmt_num_rows($stmt);
		if($resultCheck > 0)
		{
			header("Location: ../../indexs.php?signup&error=undertakenemail&".$email);
			exit();
		}
		else{

			// Now email confirmation //

		 		require 'phpmail/PHPMailerAutoload.php';

	            // Instantiation and passing `true` enables exceptions
	            $mail = new PHPMailer(true);


	                //Server settings
	                                                  // Enable verbose debug output
	                $mail->isSMTP();                                            // Set mailer to use SMTP
	                $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
	                $mail->SMTPAuth   = true;


	                // Enable SMTP authentication
	                $mail->Username   = 'tuanishstore@gmail.com';          // SMTP username
	                $mail->Password   = '@tuanish123';                        // SMTP password
	                $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
	                $mail->Port       = 465;                                    // TCP port to connect to

	                //Recipients
	                $mail->setFrom('tuanishstore@gmail.com', 'Tuanish');
	                $mail->addAddress($email);



	                $mail->isHTML(true);
	                $mail->Subject = 'Tuanishstore Signup';
	                $mail->Body    = '<div style="position:relative;border-radius:10px;margin:20px 0px;padding:30px 20px;width:auto;background:#f2f2f2;font-size:13px;text-align:left;"><b>Welcome, '.$fname.' '.$lname.'<b><br><br>
	                	Thank you for registering yourself to <b style="color:##a6a6a6;">tuanishstore</b>.We are looking forward for you to provide best service.
	                	<p style="font-weight:bold;font-size:18px;text-align:center;background:#fff;padding:4px 10px;color:deepskyblue;">Happy Shopping</p>
	                </div><br><a href="srijansingh.000webhostapp.com" style="position:relative;text-decoration:none;color:white;
	                	font-size:20px;">
	                <div style="position:relative;width:100%;background:#00bfff;padding:15px 0px;border-radius:10px;text-align:center;">
	                	Shop Now
	                	</div></a>
	                ';

	                if($mail->send())
	                {

					// email confirmation ends //
						$sql="INSERT INTO customers(customer_fname,customer_lname,customer_gender,customer_email,customer_password,customer_country,customer_state,customer_city,customer_address,customer_pincode,customer_contact,customer_image,customer_ip) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
						$stmt=mysqli_stmt_init($conn);
						if(!mysqli_stmt_prepare($stmt,$sql))
						{
							die(mysqli_error($conn));
						}
						else
						{

							$hashpwd=password_hash($password, PASSWORD_DEFAULT);

							mysqli_stmt_bind_param($stmt, "sssssssssssss", $fname,$lname,$gender,$email,$hashpwd,$customer_country,$customer_state,$customer_city,$customer_address,$customer_pincode,$customer_contact,$customer_image,$customer_ip);
							$run=mysqli_stmt_execute($stmt);
		                    if($run==true)
		                    {

		                        header("Location: ../../indexs.php?login=signup");
		                        exit();
		                    }
						}

					}
					else
					{
					  header("Location: ../../indexs.php?signup&error=notavailable");
					  exit();
					}

		    }
	}


}
else
{
	header("Location: ../signup.php");
	exit();
}
