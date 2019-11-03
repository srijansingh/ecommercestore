<?php

        $product_id=$_GET['products_id'];
        $query="DELETE FROM products WHERE product_id=:product_id";
        $run=$pdo->prepare($query);
        $run->bindParam(':product_id',$product_id,PDO::PARAM_INT);
        $run->execute();

        if($run==true)
        {
            echo "<script>alert('Your product has been successfully deleted')</script>";
            echo "<script>window.open('index.php?view_products','_self')</script>";
        }
        else
        {
            die(mysqli_error($conn));
        }

?>
