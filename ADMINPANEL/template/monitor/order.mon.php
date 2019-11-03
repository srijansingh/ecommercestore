<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="css/order.mon.css">
	<title> Title </title>
</head>

<body>
<div class="wrapper">
       <div class="band">
        <h2>Customers Order</h2>
        </div>
        <div class="recent_orders">
        <?php

            $order="SELECT * FROM pending_orders ORDER BY order_id DESC";
            $run_order=$pdo->prepare($order);
            $run_order->execute();
            $total_order=$run_order->rowCount();
            $order_row=$run_order->fetchAll(PDO::FETCH_ASSOC);

            echo "

            <table border='1'>

                <tr class='head'>
                <th>Order Id</th>
                <th>Customer Email</th>
                <th>Product Code</th>
                <th>Invoice Number</th>
                <th>Due Amount</th>
                <th>Qty</th>
                <th>Size</th>
                <th>Order Status</th>
                <th>Order Date</th>
                <th>Update</th>
                <th>Delete</th>

                </tr>

            ";


            foreach($order_row as $order_result)
            {
                echo "
               <form method='post'>
                <tr>
                <td><input type='text' name='order'  value='".$order_result['order_id']."'></td>
                <td>".$order_result['customer_email']."</td>
                <td>".$order_result['product_code']."</td>
                <td>".$order_result['invoice_no']."</td>
                <td>".$order_result['due_amount']."</td>
                <td>".$order_result['qty']."</td>
                <td>".$order_result['size']."</td>
                <td>
                    <select name='status'>
                        <option  value='".$order_result['order_status']."'>".$order_result['order_status']."</option>
                        <option value='Processing'>Processing</option>
                        <option value='Shipped'>Shipped</option>
                        <option value='Delivered'>Delivered</option>
                        <option value='Pending'>Pending</option>

                    </select>
                </td>
                <td>".$order_result['order_date']."</td>
                <td><a><button type='submit' name='status_update'>Update</button></a></td>
                <td><a href='index.php?delete_order&c=".$order_result['order_id']."'><button>Delete</button></a></td>
                </tr>
                </form>
                ";
                if(isset($_POST['status_update']))
               {
                $order_id = $_POST['order'];
                $updated_status = $_POST['status'];

                $query="UPDATE pending_orders SET order_status=:order_status WHERE order_id=:order_id";
                $run=$pdo->prepare($query);
                $run->bindParam(':order_status',$updated_status,PDO::PARAM_STR);

                $run->bindParam(':order_id',$order_id,PDO::PARAM_INT);
                $run->execute();

                if($run==true)
                {
                    header("Location: index.php?view_order");
                    exit();
                }
                    else{
                        echo "failed";
                    }
               }

            }


        ?>
        </div>
    </div>

</body>
</html>
