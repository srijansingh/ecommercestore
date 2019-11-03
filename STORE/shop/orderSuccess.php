<?php

	if(!isset($_GET['order']))
	{
		header("Location: index.php?shop");
		exit();
	}
	else
	{
		$invoice_number=$_GET['orders'];

	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
	<title>Tuanish</title>
<link rel="stylesheet" href="STORE\css\orderSuccess.css">
</head>
<body>
	<div class="success_order">

		<div class="invoice_detail">
			<h2 align="center" style="color:#fff">Order Success!</h2>
			<p>
				<span style="color:#000;;">Your order has been subbmitted successfully.<br>
				We will process your order soon.We have send an email to <a style="color:#000;font-weight:bold"><?php echo $_SESSION['customer_email']?></a> regarding order confirmation.</span>
				<div class="confirm-info">


				<span class="ids">Invoice id <b style="position:relative;float:right"><?php echo $invoice_number; ?></b></span>
				<span class="ids">Order Status <b style="position:relative;float:right;color:lawngreen">Confirmed</b></span>
				</div>
			</p>
			<div class="thanks">Thank you for shopping with us.</div>
		</div>


		<a class="shop_more" href="indexs.php?shop">Continue shopping</a>
	</div>
  <div class="head_back">
    <a href="index.php"><i class="fas fa-arrow-left"></i></a>
  </div>
</body>
</html>
