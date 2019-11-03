<?php


    $product_id=$_GET['product_id'];
    $query="DELETE FROM cart WHERE product_id=:product_id";
    $run=$pdo->prepare($query);
    $run->bindParam(':product_id',$product_id,PDO::PARAM_INT);
    $run->execute();

    if($run==true)
    {

        echo "<script>window.open('indexs.php?carts','_self')</script>";
    }
    else
    {
        die(mysqli_error($conn));
    }

?>
