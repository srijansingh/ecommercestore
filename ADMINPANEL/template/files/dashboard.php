<?php
    require 'configure/dbh.config.php';
    if(!isset($_SESSION['admin_email']))
    {
        header('Location: login.php');
        exit();
    }
    else
    {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <div class="wrapper">
       <div class="band">
        <h2>Dashboard</h2>
        </div>

        <div class="views">
            <section>
              <h2>Total Products &nbsp; <?php echo $total ;?></h2>
              <p><a href="index.php?view_products">View Products</a></p>
            </section>

            <section>
              <h2>Total Category &nbsp; <?php echo $totals ;?></h2>
              <p><a href="index.php?view_products">View Categories</a></p>
            </section>

            <section>
                <h2>Total Orders &nbsp; <?php echo $tot_order;?></h2>
                <p><a href="index.php?view_products">View Products</a></p>
            </section>

            <section>
                <h2>Total Sellings &nbsp; &#x20B9 <?php echo $tot_due;?></h2>

                <p><a href="index.php?view_products">Total Delivery: &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; <?php echo $tot_del;?> Product</a></p>
            </section>
        </div>

        <div class="recent_orders">
        <?php

            $order="SELECT * FROM pending_orders ORDER BY order_id DESC limit 0,4";
            $stmt=$pdo->prepare($order);
            $stmt->execute();
            $total_order=$stmt->rowCount();
            $order_row=$stmt->fetchAll(PDO::FETCH_ASSOC);


            echo "

            <table>
                <tr><th colspan='10' align='left'>Recent Orders</th><tr>

                <tr class='head'>
                <th>Order Id</th>
                <th>Customer Email</th>
                <th>Product Code</th>
                <th>Invoice Number</th>
                <th>Due Amount</th>
                <th>Qty</th>
                <th>Size</th>
                <th>Order Status</th>
                <th>Update</th>
                <th>Delete</th>

                </tr>

            ";


            foreach($order_row as $order_result)
            {
                echo "
               <form method='post'>
                <tr>
                <td style='background-color:transparent;border:none;'><input type='text' name='order'  value='".$order_result['order_id']."'></td>
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
                <td><a><button type='submit' name='status_update'>Update</button></a></td>
                <td><a href='index.php?delete_order=".$order_result['order_id']."'><button>Delete</button></a></td>
                </tr>
                </form>
                ";
                if(isset($_POST['status_update']))
               {
                $order_id = $_POST['order'];
                $updated_status = $_POST['status'];

                $query="UPDATE pending_orders SET order_status=:order_status WHERE order_id=:order_id";
                $run=$pdo->prepare($query);
                $run->bindParam(":order_status",$updated_status,PDO::PARAM_STR);
                $run->bindParam(":order_id",$order_id,PDO::PARAM_INT);
                $run->execute();

                if($run==true)
                {
                    header("Location: index.php?dashboard");
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
<?php
    }
?>
