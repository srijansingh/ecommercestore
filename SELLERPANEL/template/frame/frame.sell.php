<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Side Menubar</title>
	<style>
		*{
			margin:0px;
			padding:0px;
			font-family:sans-serif;
		}

		#sidebar{
			position:fixed;
			width:250px;
      top:0px;
			height:100%;
			padding:0px 0px;
			background:linear-gradient(60deg,#1a1a1a,#1a1a1a);
      opacity:0.98;
			left:-250px;
			transition:0.3s;
		}
		#sidebar.active{
			left:0px;
		}
    a{
      text-decoration:none;
    }
		li{
			position:relative;
			color:#fff;
			padding:15px 15px;
			list-style:none;
			font-size:18px;

		}
		H1{
			position:relative;
			color:#fff;
      font-size:23px;
			padding:8px 15px;
      border-bottom:1px solid #d4d4d4;
		}
		 .toggle-btn{
			position:absolute;
			left:258px;
			top:8px;
		}
		 .toggle-btn span{
			display:block;
			width:25px;
			height:3px;
			background:black;
			margin:4px 0px;
		}
		#sidebar.active .toggle-btn span{
			background: transparent;
			padding:800px 1000px;
		}
    .heading{
      position:fixed;
      top:0px;
      left:0px;
      width:100%;
      padding:10px 0px;
      background:white;
      border-bottom:1px solid #d4d4d4;
    }
    .heading a{
      position:relative;
      float:right;
      right:10px;
      font-size:20px;
      font-weight:bold;
      color:black;
    }
	</style>

	<script type="text/javascript">
		function toggleSideBar()
		{
			document.getElementById("sidebar").classList.toggle('active');
		}
	</script>
</head>
<body>
  <div class="heading">
  <a><?php echo $head ?></a>
  </div>
	<div id="sidebar">

		<div class="toggle-btn" onclick="toggleSideBar()">
			<span></span>
			<span></span>
			<span></span>
    </div>
		<ul>

			<H1><i class="fas fa-user" id="awe"></i>&nbsp;&nbsp;<?php echo $seller_name ;?></H1>
			<a href="index.php?dashboard"><li><i class="fa fa-dashboard" id="awe"></i>&nbsp;&nbsp;Dashboard</li></a>
      <a href="index.php?insert"><li><i class="fas fa-plus" id="awe"></i>&nbsp;&nbsp;Insert Product</li></a>
			<a href="index.php?view"><li><i class="fas fa-eye" id="awe"></i>&nbsp;&nbsp;View Product</li></a>
			<a href="index.php?myorder"><li><i class="fa fa-first-order" id="awe"></i>&nbsp;&nbsp;Orders</li></a>
			<a href="index.php?deliver"><li><i class="fa fa-buysellads" id="awe"></i>&nbsp;&nbsp;Delivered</li></a>
			<a href="index.php?profile"><li><i class="fas fa-user-circle" id="awe"></i>&nbsp;&nbsp;My Profile</li></a>
			<a href="index.php?logout"><li><i class="fas fa-sign-out-alt" id="awe"></i>&nbsp;&nbsp;Logout</li></a>
		</ul>
	</div>

</body>
</html>
