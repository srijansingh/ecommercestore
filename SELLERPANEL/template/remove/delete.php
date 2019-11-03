<?php

        $product_code=$_GET['product_code'];
        $query="DELETE FROM products WHERE product_code=:product_code";
        $run=$pdo->prepare($query);
        $run->bindParam(':product_code',$product_code,PDO::PARAM_INT);
        $run->execute();

        if($run==true)
        {
            
            echo "<script>window.open('index.php?view','_self')</script>";
        }
        else
        {
            die(mysqli_error($conn));
        }

?>
