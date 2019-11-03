<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Admin Signup</title>
    <link rel="stylesheet" href="css/auth.css">
    <script>

        function sign()
        {
            var a=document.getElementById('n').value;
            var b=document.getElementById('e').value;
            var c1=document.getElementById('p1').value;
            var c2=document.getElementById('p2').value;

            if(a.trim()=='' || b.trim()=='' || c1.trim()=='')
                {
                    document.getElementById("alerts").innerHTML="Please fill all required fields";
                    return false;
                }
            else if(c1.trim().length<6)
                {
                    document.getElementById("alerts").innerHTML="Password must be more than 8 digits";
                    return false;
                }
            else if(c1.trim()!=c2.trim())
                {
                    document.getElementById("alerts").innerHTML="Password mismatched";
                    return false;
                }

        }
    </script>
</head>
<body>
  <center>

     <div class="admin-info">
         <h2>Insert User</h2>
            <form  method="post" action="author.inc/signup.inc.php" onsubmit="return sign()">

            <div id="alerts">
            <?php
            if(isset($_GET['useralreadyexist']))
            {
                echo "User already exist";
            }
            ?>
            </div>
           <input type="text" name="admin_name" Placeholder="Enter Name" id="n">
           <input type="email" name="admin_email" Placeholder="Enter Email" id="e">
           <input type="password" name="password" Placeholder="Choose Password" id="p1">
           <input type="password" name="password_repeat" Placeholder="Repeat Password" id="p2">
           <input type="submit" name="subadmin" value="Insert" >

         </form>
     </div>
  </center>
</body>
</html>
