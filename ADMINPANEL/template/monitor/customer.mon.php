<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customers</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
<div class="wrapper">
    <div class="band">
        <h2>Our Customers</h2>
    </div>
    <div class="recent_orders">
   <?php

    $query="SELECT * FROM customers";
    $run=$pdo->prepare($query);
    $run->execute();
    $total=$run->rowCount();
    $row=$run->fetchAll(PDO::FETCH_ASSOC);
    echo "
        <table>
        <tr>
        <th>Customer ID</th>
        <th>Customer Name</th>
        <th>Customer Email</th>
        <th>Customer Contact</th>
        <th>Customer Address</th>

        </tr>
    ";
    foreach($row as $result)
    {
        echo "
            <tr>
            <td>".$result['customer_id']."</td>
            <td>".$result['customer_fname']."".$result['customer_lname']."</td>
            <td>".$result['customer_email']."</td>
            <td>".$result['customer_contact']."</td>
            <td>".$result['customer_address']."".$result['customer_city']."".$result['customer_country']."</td>
            </tr>
        ";
    }
echo "</table>";

?>
    </div>
    </div>
</body>
</html>
