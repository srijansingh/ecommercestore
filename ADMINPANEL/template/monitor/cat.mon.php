
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categories</title>
    <link rel="stylesheet" href="css/cat.mon.css">
</head>
<body>
    <div class="wrapper">
       <div class="band">
        <h2>Dashboard</h2>
        </div>

        <div class="recent_orders">
        <?php
            $query="SELECT * FROM cat_images";
            $run=$pdo->prepare($query);
            $run->execute();
            $rows=$run->fetchAll(PDO::FETCH_ASSOC);


            echo "
                <table>
                <tr>
                <th>Category Id</th>
                <th>Category Title</th>
                <th>Category Image</th>

                </tr>
            ";
            foreach($rows as $row)
            {
                echo "
                <tr>
                <td>".$row['cat_image_id']."</td>
                <td>".$row['cat_title']."</td>
                <td><img src='data:image/jpeg;base64,".base64_encode($row['cat_image'])."' height=100 width=></td>
                </tr>
                ";
            }
        ?>
        </table>
        </div>
    </div>
    </body>
</html>
