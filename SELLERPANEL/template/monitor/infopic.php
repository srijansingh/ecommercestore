<?php
  if(isset($_GET['details']))
  {
    $product_code=$_GET['product_code'];
    $product_title=$_GET['p'];

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tuanish</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
  <link rel="stylesheet" href="css/infopic.css">
  <script type="text/javascript">
  function next(){window.history.forward()}
  function back(){window.history.back()}
  function go(){window.history.go(1)}
  </script>
</head>
<body>
  <div class="container-img">
    <div class="imgboxs" >
      <?php
      $query="SELECT * FROM products_image WHERE product_code=:product_code limit 1";
      $run=$pdo->prepare($query);
      $run->bindParam(':product_code',$product_code,PDO::PARAM_STR);
      $run->execute();
      $row=$run->fetchAll(PDO::FETCH_ASSOC);
      foreach($row as $rows)
      {
          echo "<img id='imgbox' class='imgbox' src='data:image/jpeg;base64,".base64_encode($rows['product_img'])."' height=306 width=306>
          ";
        }
        ?>
        </div>

        <?php
        $query="SELECT * FROM products_image WHERE product_code=:product_code";
        $runs=$pdo->prepare($query);
        $runs->bindParam(':product_code',$product_code,PDO::PARAM_STR);
        $runs->execute();
        $count=$runs->rowCount();
        $rows=$runs->fetchAll(PDO::FETCH_ASSOC);
        echo "<div class='thumb' style='position:relative;display:grid;grid-gap:2px;grid-template-columns:repeat(".$count.",1fr)'>";
        foreach($rows as $row)
        {
          echo "



          <img onclick='change_image(this)' src='data:image/jpeg;base64,".base64_encode($row['product_img'])."' >
        ";
  }

  ?>
  </div>
  </div>


  <script type="text/javascript">
    var container=document.getElementById("imgbox");
    function change_image(image)
    {
      container.src=image.src;

    }

  </script>
  <div class="head_back">
    <a onclick="back()"><i class="fas fa-close"></i></a><a><?php echo $product_title;  ?></a>
  </div>
</body>
</html>
<?php } ?>
