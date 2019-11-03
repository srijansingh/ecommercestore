<?php
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
    <title>View Products</title>
    <link rel="stylesheet" href="css/product.mon.css">
</head>
<body>
<?php

    $query="SELECT * FROM products";
    $run=$pdo->prepare($query);
    $run->execute();
    $total=$run->rowCount();
    $row=$run->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="wrapper">
        <div class="band">
            <div><h2>View Products</h2></div>
            <div class="total"><b>Total products : <?php echo $total; ?></b>
                <a href="index.php?insert_products">Add More&nbsp;&nbsp;<i class="fas fa-tasks"></i></a>
            </div>
        </div>

            <?php

             if($total!=0)
                {
                 ?>

            <table >

                <tr>
                    <th>S.No</th>
                <th>Product ID</th>
                <th>Product Code</th>
                <th>Product Title</th>
                <th>Product Image</th>

                <th>Product Date</th>

                <th>Product Price</th>
                <th>Product Brand</th>
                <th>Edit</th>
                <th>Delete</th>
                </tr>
                <?php
                   $i=1;

                    foreach($row as $result)
                    {


                        echo "<tr>
                        <td>  $i </td>
                        <td><b>".$result['product_id']."</b></td>
                        <td>".$result['product_code']."</td>
                        <td>".$result['product_title']."</td>
                        <td>";
                            $query="SELECT product_img FROM products_image WHERE product_code=:product_code limit 1";
                            $run=$pdo->prepare($query);
                            $run->bindParam(':product_code',$result['product_code'],PDO::PARAM_STR);
                            $run->execute();

                            $row=$run->fetchAll(PDO::FETCH_ASSOC);
                            foreach($row as $rows)
                            {
                                echo "<img src='data:image/jpeg;base64,".base64_encode($rows['product_img'])."' height=100 width=100>";
                            }
                            $date=date('d F, Y', strtotime($result['date']));
                        echo "</td>

                        <td>".$date."</td>


                        <td>".$result['product_price']."</td>
                        <td>".$result['product_brand']."</td>
                        <td><a href='index.php?product_id=$result[product_id]'><i class='fas fa-edit'>Edit</i></a></td>
                        <td><a href='index.php?remove_product&products_id=$result[product_id]'><i class='fas fa-trash-alt'></i></a></td>
                        </tr>";
                        $i++;
                    }

                }
                else
                {
                    echo "<center><p>You dont have any product in your store</p>
                    <p class='views'><a href='index.php?insert_products'>Add some product</a></p></center>";
                }

                ?>
            </table>


    </div>
</body>
</html>
<?php } ?>
