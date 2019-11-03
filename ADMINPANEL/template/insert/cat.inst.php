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
    <title>Insert Categories</title>
    <link rel="stylesheet" href="css/cat.inst.css">

<script src="https://cloud.tinymce.com/5/tinymce.min.js?427nzxqv05duv8k1se31vxp5e7mnx00xpq6i8gzrc1idnrj9"></script>
</head>
<body>
    <div class="wrapper">
        <div class="band">
            <h2>Insert Categories</h2>
        </div>

    <div class="form">
       <form action="" method="post" enctype="multipart/form-data" >
        <label for="category_name">Category Title</label>
        <input type="text" name="cat_title" placeholder="" class="input" required>
        <label for="category_name">Category Image</label>
        <input type="file" name="image[]" multiple accept=".jpg,.png,.gif" class="input" required>
        <label for="">Category Description</label>
        <textarea name="cat_desc" id="" cols="30" rows="7" class="input" required></textarea>
        <label for="submit"></label>
        <input type="submit" name="subcat" class="subcat" value="Insert Categories">
       </form>

       <?php
        if(isset($_POST['subcat']))
        {

             $cat_title=$_POST['cat_title'];
             $cat_desc=$_POST['cat_desc'];
             $email=$row['admin_email'];
             $check_title="SELECT * FROM categories WHERE cat_title=:cat_title";
             $check_run=$pdo->prepare($check_title);
             $check_run->bindParam(':cat_title',$cat_title,PDO::PARAM_STR);
             $check_run->execute();
             $check=$check_run->rowCount();

             if(count($_FILES["image"]["tmp_name"])>0)
            {
                for($count=0;$count<count($_FILES["image"]["tmp_name"]); $count++)
                {
                    $image_file=addslashes(file_get_contents($_FILES["image"]["tmp_name"][$count]));
                    $query="INSERT INTO cat_images(cat_title,cat_image) VALUES('$cat_title','$image_file')";
                    $run=mysqli_query($conn,$query);

                }
            }


             if($check==true)
             {
                 echo "<script>alert('$cat_title already exist. Try another')</script>";
                 echo "<script>window.open(index.php?insert_categories)</script>";
             }
             else
             {

                 $query="INSERT INTO categories(email,cat_title,cat_desc) VALUES(:email,:cat_title,:cat_desc)";
                 $run=$pdo->prepare($query);
                 $run->bindParam(':email',$email,PDO::PARAM_STR);
                 $run->bindParam(':cat_title',$cat_title,PDO::PARAM_STR);
                 $run->bindParam(':cat_desc',$cat_desc,PDO::PARAM_STR);
                 $run->execute();
                 if($run==true)
                 {
                     echo "<script>alert('Your New Category Inserted Successfully')</script>";
                 }
                 else
                 {
                     echo errorinfo();
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
