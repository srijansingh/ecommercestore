
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Admin Signup</title>
    <link rel="stylesheet" href="css/auth.css">
    <script>


    </script>
</head>
<body>
  <center>

     <div class="admin-info">
         <h2>Insert User</h2>
            <form  method="post" action="index.php?subseller" enctype="multipart/form-data" onsubmit="return sign()">

            <div id="alerts">
            <?php
            if(isset($_GET['useralreadyexist']))
            {
                echo "User already exist";
            }
            ?>
            </div>
           <input type="text" name="seller_fname" Placeholder="Enter First Name" id="n">
           <input type="text" name="seller_lname" Placeholder="Enter Last Name" id="n">
           <input type="text" name="shop_name" Placeholder="Enter Shop Name" id="n">
           <input type="email" name="seller_email" Placeholder="Enter Email" id="e">
           <input type="password" name="password" Placeholder="Choose Password" id="p1">
           <input type="number" name="seller_contact" placeholder="contact">
           <input type="address" name="seller_city"  placeholder="city">
           <input type="file" name="file" >
           <input type="address" name="seller_address" placeholder="address">
           <input type="number" name="seller_pincode" placeholder="pincode">
           <input type="text" name="seller_link" placeholder="link">
           <input type="submit" name="subseller" value="Insert" >

         </form>
     </div>
  </center>
</body>
</html>
