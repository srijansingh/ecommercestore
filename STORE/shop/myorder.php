

<?php
	if(!isset($_GET['myorders']))
	{
		echo "<h1 style='position:absolute;top:100px;left:0px;width:100%;padding:50px 0px;text-align:center;background:#ccc;'>Unauthorised Access</h1>";
	}
	else
	{
		?>

		<html>
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>

			<title>My Orders</title>
			<script type="text/javascript">
			function next(){window.history.forward()}
			function back(){window.history.back()}
			function go(){window.history.go(1)}
			</script>
			<link rel="stylesheet" href="STORE\css\myorder.css">
		</head>
		<body>
		<div class="main-box">
		<?php

		$customer_email=$_SESSION['customer_email'];

		$query="SELECT * FROM pending_orders WHERE customer_email=:customer_email";
		$run_query=$pdo->prepare($query);
    $run_query->bindParam(':customer_email',$customer_email,PDO::PARAM_STR);
    $run_query->execute();


		$total_orders=$run_query->rowCount();
    $row=$run_query->fetchAll(PDO::FETCH_ASSOC);
		if($total_orders>0)
		{
				foreach($row as $rows)
				{
					$product_title=$rows['product_title'];
					$product_size=$rows['size'];
					$order_id=$rows['order_id'];
					$invoice_no=$rows['invoice_no'];
					$price=$rows['due_amount'];
					$delivery_date=date('d F, Y', strtotime($rows['del_date']));

					$dat = date('d F, Y', strtotime($rows['order_date'])); //date format
					$date_del = DateTime::createFromFormat('Y-m-d H:i:s',$rows['order_date']);
					$date_del->modify('+1 week');
					$new=$date_del->format('d F, Y');

					$product_code=$rows['product_code'];
					$order_status=$rows['order_status'];

					$query_pic="SELECT * FROM products_image WHERE product_code=:product_code limit 1";
					$run_pic=$pdo->prepare($query_pic);
          $run_pic->bindParam(':product_code',$product_code,PDO::PARAM_STR);
          $run_pic->execute();
					$tot_pic=$run_pic->rowCount();
          $pic=$run_pic->fetchAll(PDO::FETCH_ASSOC);
					foreach($pic as $pics)
					{
						echo '
							<section>
							<div class="dates">
								<div style="color:#a6a6a6">ORDER DATE &nbsp;<font style="color:#000">'.$dat.'</font></div>
								<div class="right">ORDER ID &nbsp;<font style="color:#000">'.$order_id.'</font></div>
							</div>
							<div class="detailing">
								<div class="imgs">
									<img src="data:image/jpeg;base64,'.base64_encode($pics['product_img']).'" >
								</div>
								<div class="pro_info">
									<div class="pro_titls">'.$product_title.'</div>
									<div class="pro_titls">&#x20B9 '.$price.' | SIZE: '.$product_size.'</div><br><br><br>';
									if($order_status!='Delivered')
									{
										echo
										'
										<div class="del_date">
										<div style="color:#a6a6a6;font-size:12px;">EXPT. DELIVERY DATE</div>
										<div><font style="color:#000">'.$new.'</font></div>
										</div>
										';
									}
									else
									{
										echo
										'
										<div class="del_date">
										<div style="color:#a6a6a6;font-size:12px;">PRODUCT DELIVERED ON</div>
										<div><font style="color:#a6a6a6">'.$delivery_date.'</font></div>
										</div>
										';
									}
								echo '
								</div>
							</div>'
							;
							if($order_status=='Delivered')
							{
								echo '
								<div class="status" style="color:green;background:#fff;font-weight:bold;">
								'.$order_status.'
								</div>';
							}
							else
							{
								echo '
								<div class="status" style="color:#00bfff">
								'.$order_status.'
								</div>';
							}
							echo '
							</section>
						';


					}

				}
			}
			else
			{
				echo '

        <div class="noitems">
      		<div class="icon">
      			<i class="fas fa-ticket-alt" id="icons"></i></a>
      		</div>
      		<div class="items" style="color:#a6a6a6;">
      			oops! I am empty.
      		</div>
      		<div class="go">
      			<a href="index.php">Go to Catalog</a>
      		</div>

      	</div>


				';
			}
	}

?>
</div>
<div class="head_back">
  <a onclick="back()"><i class="fas fa-arrow-left"></i></a>
</div>
</body>
</html>
