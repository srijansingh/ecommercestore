<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
     <link rel="stylesheet" href="css/auth.css">
           <script>
       
        function fun()
        {
            var a=document.getElementById('e').value;
            var b=document.getElementById('p').value;
            
            if(a.trim()=='' || b.trim()=='')
                {
                    document.getElementById('alerts').innerHTML='Please enter email and password';
                    return false;
                }
        }
    </script>
</head>
<body>
     
   <center>
     <div class="admin-info">
            <h2>Login Admin</h2>
    <form  action="author.inc/login.inc.php" method="post" onsubmit="return fun()">
       <div class="alerts" id="alerts"></div>
        
            <input type="email" name="email" id="e" placeholder="Enter Email">
            <input type="password" name="password" id="p" placeholder="Enter Placeholder">
            <input type="submit" name="logauth" Value="Login">
     
    </form>
</div>
</center>
</body>
</html>