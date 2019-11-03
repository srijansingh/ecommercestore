<?php
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" type="text/css" href="STORE/css/signup.css">
	<title> Tuanish</title>
</head>
<body>

<div class="login-box">
    <div class="heading">
      <h2>Signup Here</h2>
    </div>

     <form action="AUTH\author.inc\signup.auth.php" method="post">
    <div class="form-data">
        <?php
            if($_GET['error']=='passwordCheck')
            {
                echo "<p style='color:darkred; text-align:left'>*Password Mismatched</p>";
            }

            if($_GET['error']=='invalidmail')
            {
                echo "<p style='color:darkred; text-align:left'>*Invalid Email</p>";
            }
            if($_GET['error']=='emptyfields')
            {
                echo "<p style='color:darkred; text-align:left'>*Fields are empty</p>";
            }
            if($_GET['error']=='undertakenemail')
            {
                echo "<p style='color:darkred; text-align:left'>*Email is already taken by another user</p>";
            }
            if($_GET['error']=='notavailable')
            {
                echo "<p style='color:darkred; text-align:left'>*Email does not exist</p>";
            }
        ?>
        <label>First Name</label>
        <input type="text" name="fname" placeholder="Enter your first name">
        <label>Last Name</label>
        <input type="text" name="lname" placeholder="Enter your last name">
        <label>Gender</label>
        <select name="gender" >
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
        <label>Email</label>
        <input type="text" name="email" placeholder="Enter your email">
         <label>Mobile Number</label>
        <input type="number" name="contact" placeholder="Enter your mobile number">
        <label>Choose Password</label>
        <input type="password" name="password" placeholder="Choose your password">
        <label>Repeat Password</label>
        <input type="password" name="passwordRepeat" placeholder="Repeat your password">
         
        
        
    </div>

    </form>
    <input type="submit" name="signup" value="Signup"><br>  
<label><a href="indexs.php?login">Already have account? Login</a></label>
  </div>


    </body>
</html>
