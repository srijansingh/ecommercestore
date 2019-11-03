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
    <title>Insert Products</title>
    <link rel="stylesheet" href="css/product.inst.css">

</head>
<body>

    <div class="wrapper">
        <div class="band">
            <h2>Insert Products</h2>
        </div>
        <div class="form">
            <form action="" method="post" enctype="multipart/form-data">
                <table>
                    <tr><td class="nam">Product Title</td><td><input type="text" name="p_title" placeholder="Enter product title\shirts,pant....." required></td></tr>

                    <!--Product Categories-->
                     <tr>
                        <td class="nam">Product Category</td>
                        <td><select name="product_cat_title">
                            <option selected disabled="Select Product Categories">Select Main Category</option>
                            <?php

                                $query="SELECT * FROM products_categories";
                                $run=$pdo->prepare($query);
                                $run->execute();
                                $total=$run->rowCount();
                                $row=$run->fetchAll(PDO::FETCH_ASSOC);
                                foreach($row as $result)
                                {
                                    $product_cat_title=$result['product_cat_title'];
                                    $cat_id=$result['product_cat_id'];
                                    echo "<option>".$product_cat_title."</option>";
                            }
                            ?>
                            </td>
                        </select>
                    <tr>


                    <!--Product Sub Categories-->
                    <tr><td class="nam">Product Sub Category</td>
                        <td>
                            <select name="p_cat" id="pcat">
                            <option selected disabled="" value="hidden">Select Product Category</option>
                        <?php

                            $query="SELECT * FROM categories";
                            $run=$pdo->prepare($query);
                            $run->execute();
                            $total=$run->rowCount();
                            $row=$run->fetchAll(PDO::FETCH_ASSOC);
                            foreach($row as $result)
                            {
                                $cat_title=$result['cat_title'];
                                $cat_id=$result['cat_id'];
                           echo "<option>".$cat_title."</option>";
                            }
                        ?>
                            </select>
                        </td></tr>

                     <tr>
                        <td class="nam">Product Sizing Category</td>
                        <td>
                            <select name="product_sizing" id="pcat">
                            <option  disabled>Select Sizing Category</option>
                            <option value="Top Wear">Top Wear</option>
                            <option value="Bottom Wear">Bottom Wear</option>
                            <option value="Footwear">Footwear</option>
                            <option selected value="None">None</option>

                            </select>
                        </td>

                     </tr>
                    <tr><td class="nam">Product Image</td><td><input type="file" name="image[]" multiple accept=".jpg, .png, .gif" required></td></tr>

                    <tr><td class="nam">Color</td><td><input type="color" style="width:100px;padding:0px;border-radius:0px; height:30px;" value="#fff000" name="p_color" required>Choose Color</td></tr>
                    <tr><td class="nam">Pattern</td><td><input type="text" name="p_pattern" placeholder="Product paattern like solid,lined,multple color" required></td></tr>
                    <tr><td class="nam">Fabric</td><td><input type="text" name="p_fabric" placeholder="Product Fabric like cotton, silk," required></td></tr>

                    <tr><td class="nam">Cost Price</td><td><input type="number" name="p_o_price" placeholder="Original Price" required></td></tr>
                    <tr><td class="nam">Selling Price</td><td><input type="number" name="p_price" placeholder="Product Price" required></td></tr>


                    <tr><td><input type="hidden" name="cat_title" value="<?php echo $cat_title=$result['cat_title'];?>" ></td></tr>
                    <tr><td class="nam">Brand Name</td><td><input type="text" name="p_brand" placeholder="Brand Name" required></td></tr>
                    <tr><td class="nam">Brand  Detail</td><td><textarea class="tinymce" cols="30" rows="6" name="p_brand_desc" ></textarea></td></tr>

                    <tr><td class="nam">Care Details</td><td><textarea class="tinymce" name="p_desc" id="" cols="30" rows="6"></textarea></tr>
                    <tr><td></td><td><input type="submit" name="submit" value="Insert" onclick="return fun()"></td></tr>

                </table>
            </form>

            <script src="js/tinymce/tinymce.min.js"></script>
            <script>tinymce.init({ selector:'textarea'});</script>
        </div>


    </div>

    <?php

     if(isset($_POST['submit']))
         {
            $p_title=$_POST['p_title'];
            $p_cat_title=$_POST['p_cat'];
            $p_color=$_POST['p_color'];
            $p_pattern=$_POST['p_pattern'];
            $p_brand=$_POST['p_brand'];
            $p_brand_desc=$_POST['p_brand_desc'];
            $p_fabric=$_POST['p_fabric'];
            $product_cat_title=$_POST['product_cat_title'];
            $p_price=$_POST['p_price'];

            $p_desc=$_POST['p_desc'];
            $product_sizing=$_POST['product_sizing'];
            $original_price=$_POST['p_o_price'];


            if($p_price<999)
            {
                $tax=5;
            }
            else
            {
                $tax=12;
            }
            $pro_tax=$tax/100*$p_price;
            $product_price=$p_price+$pro_tax;


            if($original_price<$product_price)
            {
                $p_discount=0;
            }
             else
             {
                 $pro_discount=$product_price/$original_price*100;
                 $p_discount=100-$pro_discount;
             }

            $year=1906;
            $newgid=sprintf('%05d', rand(0,999999));
            $product_code=strtolower($year."".$newgid);


            }
       ?>
            <!--Inerting product to database.-->
    <?php


    if(isset($_POST['submit']))
    {
        if(count($_FILES["image"]["tmp_name"])>0)
            {
                for($count=0;$count<count($_FILES["image"]["tmp_name"]); $count++)
                {
                    $image_file=addslashes(file_get_contents($_FILES["image"]["tmp_name"][$count]));
                    $insert_pic="INSERT INTO products_image(product_code,product_img) VALUES('$product_code','$image_file')";
                    $runs=mysqli_query($conn,$insert_pic);
                    if($runs==false)
                    {

                    }
                }
            }



            $insert="INSERT INTO products(product_code,product_cat_title,cat_title,product_sizing,product_title,original_price,product_price,product_discount,product_desc,product_color,product_pattern,product_brand,product_brand_info,product_fabric) VALUES(:product_code,:product_cat_title,:cat_title,:product_sizing,:product_title,:original_price,:product_price,:product_discount,:product_desc,:product_color,:product_pattern,:product_brand,:product_brand_info,:product_fabric)";
            $run=$pdo->prepare($insert);
            $run->bindParam(':product_code',$product_code,PDO::PARAM_STR);
            $run->bindParam(':product_cat_title',$product_cat_title,PDO::PARAM_STR);
            $run->bindParam(':cat_title',$p_cat_title,PDO::PARAM_STR);
            $run->bindParam(':product_sizing',$product_sizing,PDO::PARAM_STR);
            $run->bindParam(':product_title',$p_title,PDO::PARAM_STR);
            $run->bindParam(':original_price',$original_price,PDO::PARAM_INT);
            $run->bindParam(':product_price',$product_price,PDO::PARAM_INT);
            $run->bindParam(':product_discount',$p_discount,PDO::PARAM_INT);
            $run->bindParam(':product_desc',$p_desc,PDO::PARAM_STR);
            $run->bindParam(':product_color',$p_color,PDO::PARAM_STR);
            $run->bindParam(':product_pattern',$p_pattern,PDO::PARAM_STR);
            $run->bindParam(':product_brand',$p_brand,PDO::PARAM_STR);
            $run->bindParam(':product_brand_info',$p_brand_desc,PDO::PARAM_STR);
            $run->bindParam(':product_fabric',$p_fabric,PDO::PARAM_STR);
            $run->execute();
            if($run==true)
            {
                echo "<script>alert('Data inserted successfully')</script>";

            }


    }
    ?>



</body>
</html>


<?php
    }
?>
