<?php
    session_start();
    if(!isset($_SESSION['admin_email']))
    {
        header('Location: authority/login.author.php');
        exit();
    }
    else
    {
        require 'configure/dbh.config.php';

        #For admin name
        $email=$_SESSION['admin_email'];
        $sql_name="SELECT * FROM admins WHERE admin_email=:admin_email";
        $stmt=$pdo->prepare($sql_name);
        $stmt->bindParam(":admin_email",$email,PDO::PARAM_STR);
        $stmt->execute();
        $info=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($info as $row)
        {
            $name=$row['admin_name'];

        }

        #FOR PRODUCTS

        $sqli_pro="SELECT * FROM products";
        $st=$pdo->prepare($sqli_pro);
        $st->execute();
        $total=$st->rowCount();

        #FOR CATEGORIES

        $sqli_cat="SELECT * FROM categories";
        $sts=$pdo->prepare($sqli_cat);
        $sts->execute();
        $totals=$sts->rowCount();

        #TOTAL ORDERS
        $order_total="SELECT * FROM customer_orders";
        $stmts=$pdo->prepare($order_total);
        $stmts->execute();
        $tot_order=$stmts->rowCount();

        #tot_selling
        $p_order="SELECT * FROM pending_orders WHERE order_status='Delivered'";
        $p_runs=$pdo->prepare($p_order);
        $p_runs->execute();
        $tot_del=$p_runs->rowCount();
        $result=$p_runs->fetchAll(PDO::FETCH_ASSOC);
        $tot_dues=0;
        foreach($result as $rows)
        {
            $del_cost=$rows['due_amount'];
            $tot_dues += $del_cost;
        }

        if($tot_dues>0)
        {
            $tot_due=$tot_dues;
        }
        else
        {
            $tot_due=0;
        }



        #REDIRECT PAGE
        if(isset($_GET['logout']))
        {
            require 'authority/logout.php';
        }



        #FILES FOLDER

        if(isset($_GET['dashboard']))
        {
            require'template/files/dashboard.php';
            require'template/frame/head.frame.php';
        }


        if(isset($_GET['logout']))
        {
            include("logout.php");
            require'template/frame/head.frame.php';
        }

        #INSERT FOLDER

        if(isset($_GET['insert_products']))
        {
            require 'template/insert/product.inst.php';
            require 'template/frame/head.frame.php';
        }
        if(isset($_GET['insert_categories']))
        {
            require 'template/insert/cat.inst.php';
            require 'template/frame/head.frame.php';
        }
        if(isset($_GET['insert_products_categories']))
        {
            require 'template/insert/maincat.inst.php';
            require 'template/frame/head.frame.php';
        }
        if(isset($_GET['slider']))
        {
            require 'template/insert/slide.inst.php';
            require 'template/frame/head.frame.php';
        }


        #VIEW FOLDER

        if(isset($_GET['view_products']))
        {
            require 'template/monitor/product.mon.php';
            require 'template/frame/head.frame.php';
        }

        if(isset($_GET['view_order']))
        {
            require 'template/monitor/order.mon.php';
            require 'template/frame/head.frame.php';
        }
        if(isset($_GET['view_cat']))
        {
            require 'template/monitor/cat.mon.php';
            require 'template/frame/head.frame.php';

        }
        if(isset($_GET['view_customer']))
        {
            require 'template/monitor/customer.mon.php';
            require 'template/frame/head.frame.php';
        }
        if(isset($_GET['view_user']))
        {
            require 'template/monitor/user.mon.php';
            require'template/frame/head.frame.php';
        }

        #UPDATE FOLDER

        if(isset($_GET['product_id']))
        {
            require 'template/update/product.update.php';
            require 'template/frame/head.frame.php';
        }

        #REMOVE FOLDER

        if(isset($_GET['delete_order']))
        {
            require 'delete_order.php';

        }
        if(isset($_GET['remove_product']))
        {
          require 'template/remove/delete_product.php';
        }

        #CONFIGURE FOLDER

        if(isset($_GET['insert_user']))
        {
            require 'authority/signup.author.php';

        }
        if(isset($_GET['insert_seller']))
        {
          require 'authority/seller.signup.php';
        }
        if(isset($_GET['subadmin']))
        {
          require 'authority/author.inc/signup.inc.php';
        }

        if(isset($_GET['subseller']))
        {
          require 'authority/author.inc/seller.inc.php';
        }



    }
