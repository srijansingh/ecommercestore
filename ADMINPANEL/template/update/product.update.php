<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="css/product.inst.css">
</head>
<body>



<?php

    if(isset($_GET['product_id']))
    {

        $product_id=$_GET['product_id'];

        $query="SELECT * FROM products where product_id=:product_id";
        $run=$pdo->prepare($query);
        $run->bindParam(':product_id',$product_id,PDO::PARAM_INT);
        $run->execute();
        $row=$run->fetchAll(PDO::FETCH_ASSOC);
        foreach($row as $result)
        {

        $product_title=$result['product_title'];
        $product_cat_title=$result['product_cat_title'];
        $cat_title=$result['cat_title'];
        $product_sizing=$result['product_sizing'];
        $product_code=$result['product_code'];
        $product_color=$result['product_color'];
        $product_pattern=$result['product_pattern'];
        $product_brand=$result['product_brand'];
        $product_brand_info=$result['product_brand_info'];
        $care_info=$result['product_desc'];
        $product_fabric=$result['product_fabric'];
        $cost_price=$result['original_price'];
        $product_price=$result['product_price'];

?>
    <div class="wrapper">
        <div class="band">
            <h2>Insert Products</h2>
        </div>

        <div class="form">

            <form method="post" enctype="multipart/form-data">
                <table>
                    <tr><td class="nam">Product Title</td><td><input type="text" name="p_title" placeholder="Enter product title\shirts,pant....." value="<?php echo $product_title; ?>" required></td></tr>

                    <!--Product Categories-->
                     <tr>
                        <td class="nam">Product Category</td>
                        <td><select name="product_cat_title">

                            <option  value="<?php echo $product_cat_title; ?>"><?php echo $product_cat_title; ?></option>
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
                                    echo "<option value='".$product_cat_title."'>".$product_cat_title."</option>";
                            }
                            ?>
                            </td>
                        </select>
                    <tr>


                    <!--Product Sub Categories-->
                    <tr><td class="nam">Product Sub Category</td>
                        <td>
                            <select name="p_cat" id="pcat">
                            <option disabled="" value="hidden">Select Product Category</option>
                            <option value="<?php echo $cat_title;?>"><?php echo $cat_title;?></option>
                        <?php

                            $query="SELECT * FROM categories";
                            $run=$pdo->prepare($query);
                            $run->execute();
                            $total=$run->rowCount();
                            $row=$run->fetchAll();


                            foreach($row as $result)
                            {
                                $cat_title=$result['cat_title'];
                                $cat_id=$result['cat_id'];
                           echo "<option value='".$cat_title."'>".$cat_title."</option>";
                            }
                        ?>
                            </select>
                        </td></tr>

                     <tr>
                        <td class="nam">Product Sizing Category</td>
                        <td>
                            <select name="product_sizing" id="pcat">

                            <option selected value="<?php echo $product_sizing ; ?>"><?php echo $product_sizing ; ?></option>
                            <option value="Top Wear">Top Wear</option>
                            <option value="Top Wear">Bottom Wear</option>
                            <option value="Top Wear">Footwear</option>

                            </select>
                        </td>

                     </tr>
                    <tr><td class="nam">Product Image</td>
                    <td>
                    <?php

                    $query="SELECT * FROM products_image WHERE product_code=:product_code";
                    $run=$pdo->prepare($query);
                    $run->bindParam(':product_code',$product_code,PDO::PARAM_INT);
                    $run->execute();
                    $rows=$run->fetchAll(PDO::FETCH_ASSOC);

                     foreach($rows as $row)
                     {
                      echo "<img src='data:image/jpeg;base64,".base64_encode($row['product_img'])."' height=100 width=100>";

                     }
                     ?>
                    </td></tr>

                    <tr><td class="nam">Color</td><td><input type="color" style="width:100px;padding:0px;border-radius:0px; height:30px;" value="<?php echo $product_color;?>" name="p_color" required>Choose Color</td></tr>
                    <tr><td class="nam">Pattern</td><td><input type="text" name="p_pattern" value="<?php echo $product_pattern;?>" required></td></tr>
                    <tr><td class="nam">Fabric</td><td><input type="text" name="p_fabric" value="<?php echo $product_fabric;?>" required></td></tr>

                    <tr><td class="nam">Cost Price</td><td><input type="number" name="p_o_price" value="<?php echo $cost_price;?>" placeholder="Original Price" required></td></tr>
                    <tr><td class="nam">Selling Price</td><td><input type="number" name="p_price" value="<?php echo $product_price;?>" placeholder="Product Price" required></td></tr>
                    <tr><td class="nam">Brand Name</td><td><input type="text" name="p_brand" value="<?php echo $product_brand;?>" required></td></tr>
                    <tr><td class="nam">Brand  Detail</td><td><textarea class="tinymce" value="<?php echo $product_brand_info;?>" cols="30" rows="6" name="p_brand_desc" ><?php echo $product_brand_info;?></textarea></td></tr>

                    <tr><td class="nam">Care Details</td><td><textarea class="tinymce" value="<?php echo $care_info;?>" name="p_desc" id="" cols="30" rows="6"><?php echo $care_info;?></textarea></tr>
                    <tr><td></td><td><input type="submit" name="submit" value="Update" onclick="return fun()"></td></tr>

                </table>
            </form>
            <!-- Query for update data -->

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

                    $query="UPDATE products SET product_title=:product_title,cat_title=:cat_title,product_color=:product_color,product_pattern=:product_pattern,product_brand=:product_brand,product_brand_info=:product_brand_info,product_fabric=:product_fabric,product_cat_title=:product_cat_title,product_price=:product_price,product_desc=:product_desc,product_sizing=:product_sizing,original_price=:original_price WHERE product_code=:product_code";
                    $run=$pdo->prepare($query);
                    $run->bindParam(':product_code',$product_code,PDO::PARAM_INT);
                    $run->bindParam(':product_title',$p_title,PDO::PARAM_STR);
                    $run->bindParam(':cat_title',$p_cat_title,PDO::PARAM_STR);
                    $run->bindParam(':product_color',$p_color,PDO::PARAM_STR);
                    $run->bindParam(':product_pattern',$p_pattern,PDO::PARAM_STR);
                    $run->bindParam(':product_brand',$p_brand,PDO::PARAM_STR);
                    $run->bindParam(':product_brand_info',$p_brand_desc,PDO::PARAM_STR);
                    $run->bindParam(':product_fabric',$p_fabric,PDO::PARAM_STR);
                    $run->bindParam(':product_cat_title',$product_cat_title,PDO::PARAM_STR);
                    $run->bindParam(':product_price',$p_price,PDO::PARAM_INT);
                    $run->bindParam(':product_desc',$p_desc,PDO::PARAM_STR);
                    $run->bindParam(':product_sizing',$product_sizing,PDO::PARAM_STR);
                    $run->bindParam(':original_price',$original_price,PDO::PARAM_INT);
                    $run->execute();
                    if($run==true)
                    {
                        echo "<script>alert('success')</script>";
                        echo "<script>window.open('index.php?view_products','_self')</script>";


                    }
                    else
                    {
                       error_reporting(E_ALL);
                    }

                }

            ?>

            <!-- Query ends here -->


    </div>
    </div>
</body>
</html>


<?php
        }
   }


?>
