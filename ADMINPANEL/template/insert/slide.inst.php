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

        <label for="submit"></label>
        <input type="submit" name="subcat" class="subcat" value="Insert Categories">
       </form>

       <?php
        if(isset($_POST['subcat']))
        {

             $cat_title=$_POST['cat_title'];
             $cat_desc=$_POST['cat_desc'];
             $email=$row['admin_email'];


             if(count($_FILES["image"]["tmp_name"])>0)
            {
                for($count=0;$count<count($_FILES["image"]["tmp_name"]); $count++)
                {
                    $image_file=addslashes(file_get_contents($_FILES["image"]["tmp_name"][$count]));
                    $query="INSERT INTO slider(cat_title,cat_image) VALUES('$cat_title','$image_file')";
                    $run=mysqli_query($conn,$query);
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
