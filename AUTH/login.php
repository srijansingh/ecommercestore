<?php
error_reporting(0);
if(isset($_SESSION['customer_email']))
{

}
else
{
?>



<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" type="text/css" href="STORE/css/login.css">

</head>
<body>
  <div class="login-box">
    <div class="heading">
      <h2>Login Here</h2>
    </div>
    <div class="logo">
      <img src="user/boys.png" >
    </div>
     <form action="AUTH\author.inc\login.auth.php" method="post">
    <div class="form-data">
	<?php
			if($_GET['error']=='nouser')
			{
				echo "<p style='color:darkred; text-align:center'>*No user found</p>";
			}
			if($_GET['error']=='wrongpswd')
			{
				echo "<p style='color:darkred; text-align:center'>*Wrong Password</p>";
			}
			if($_GET['error']=='emptyfields')
			{
				echo "<p style='color:darkred; text-align:center'>*Fields are empty</p>";
			}
			if($_GET['login']=='signup')
			{
				echo "<p style='color:lawngreen; text-align:center'>*Signup success, Login now</p>";
			}

		?>
        <label>Email</label>
        <input type="text" name="customers_email" placeholder="Enter your email">
        <label>Password</label>
		<input type="password" name="customers_password" placeholder="Enter your password">
		<?php


		?>
        

		<input type="submit" name="login" value="Login">
		<label><a href="indexs.php?signup">Do not have account? Signup</a><br><a href="">Forget Password</a></label>

    </div>
    </form>
  </div>
</body>
</html>
<?php
}



?>
