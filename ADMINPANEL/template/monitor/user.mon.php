

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <div class="wrapper">
       <div class="band">
        <h2>Dashboard</h2>
        </div>
        <div class="recent_orders">
        <?php

            $query="SELECT * FROM admins";
            $run=$pdo->prepare($query);
            $run->execute();
            $rows=$run->fetchAll(PDO::FETCH_ASSOC);

            echo "
            <table>
            <tr>
            <th>Admin Id</th>
            <th>Admin Name</th>
            <th>Admin Email</th>
            <th>Admin Contact</th>
            <th>Admin Job</th>
            <th>Reg Date</th>

            </tr>

            ";

            foreach($rows as $row)
            {
                $date=date('d F, Y', strtotime($row['reg_date']));
                echo "
                <tr>
                <td>".$row['admin_id']."</td>
                <td>".$row['admin_name']."</td>
                <td>".$row['admin_email']."</td>
                <td>".$row['admin_contact']."</td>
                <td>".$row['admin_job']."</td>
                <td>".$date."</td>
                </tr>

                ";
            }
        ?>

       </table>
    </div>
    </div>
    </body>
    </html>
