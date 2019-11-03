
<?php

    if(!isset($_POST['confirm_order']))
    {
        header("Location: indexs.php?error=unauthorisedaccess");
        exit();
    }
    else
    {
        ob_start();

            $payment_way=$_POST['payment'];
            $delivery_address=$_POST['delivery_address'];
            $order_status="Confirmed";
            $year=1906;
            $newgid=sprintf('%05d', rand(0,999999));
            global $invoice_number;
            $invoice_number=strtolower($year."".$newgid);
            global $invoice_number;
            $customer_email=$_SESSION['customer_email'];

            $query="SELECT * FROM cart WHERE customer_email=:customer_email";
            $run=$pdo->prepare($query);
            $run->bindParam(':customer_email',$customer_email,PDO::PARAM_STR);
            $run->execute();

            $total_product_in_cart=$run->rowCount();
            $row=$run->fetchAll(PDO::FETCH_ASSOC);
            $total=0;
            foreach($row as $result)
            {

                $product_code=$result['product_code'];
                $product_qty=$result['qty'];
                $product_size=$result['size'];
                $queries="SELECT * FROM products WHERE product_code=:product_code";
                $runs=$pdo->prepare($queries);
                $runs->bindParam(':product_code',$product_code,PDO::PARAM_STR);
                $runs->execute();
                $row=$runs->fetchAll(PDO::FETCH_ASSOC);
                foreach($row as $results)
                {
                    $seller=$results['product_seller'];
                    $product_title=$results['product_title'];
                    $product_price = $results['product_price'];


                    $subtotal=$results['product_price']*$product_qty;
                    $total += $subtotal;

                    $insert_order = "INSERT INTO customer_orders (email,product_code,product_title,due_amount,invoice_no,qty,size,order_status,delivery_address,product_seller) VALUES(:email,:product_code,:product_title,:due_amount,:invoice_no,:qty,:size,:order_status,:delivery_address,:product_seller)";
                    $run_order =$pdo->prepare($insert_order);
                    $run_order->bindParam(':email',$customer_email,PDO::PARAM_STR);
                    $run_order->bindParam(':product_code',$product_code,PDO::PARAM_STR);
                    $run_order->bindParam(':product_title',$product_title,PDO::PARAM_STR);
                    $run_order->bindParam(':due_amount',$subtotal,PDO::PARAM_INT);
                    $run_order->bindParam(':invoice_no',$invoice_number,PDO::PARAM_INT);
                    $run_order->bindParam(':qty',$product_qty,PDO::PARAM_INT);
                    $run_order->bindParam(':size',$product_size,PDO::PARAM_STR);
                    $run_order->bindParam(':order_status',$order_status,PDO::PARAM_STR);
                    $run_order->bindParam(':delivery_address',$delivery_address,PDO::PARAM_STR);
                    $run_order->bindParam(':product_seller',$seller,PDO::PARAM_STR);
                    $run_order->execute();
                    if($run_order==true)
                    {
                       $insert_pending="INSERT INTO pending_orders (customer_email,product_code,product_title,due_amount,invoice_no,qty,size,order_status,delivery_address,product_seller) VALUES(:customer_email,:product_code,:product_title,:due_amount,:invoice_no,:qty,:size,:order_status,:delivery_address,:product_seller)";
                       $run_pending =$pdo->prepare($insert_pending);
                       $run_pending->bindParam(':customer_email',$customer_email,PDO::PARAM_STR);
                       $run_pending->bindParam(':product_code',$product_code,PDO::PARAM_STR);
                       $run_pending->bindParam(':product_title',$product_title,PDO::PARAM_STR);
                       $run_pending->bindParam(':due_amount',$subtotal,PDO::PARAM_INT);
                       $run_pending->bindParam(':invoice_no',$invoice_number,PDO::PARAM_INT);
                       $run_pending->bindParam(':qty',$product_qty,PDO::PARAM_INT);
                       $run_pending->bindParam(':size',$product_size,PDO::PARAM_STR);
                       $run_pending->bindParam(':order_status',$order_status,PDO::PARAM_STR);
                       $run_pending->bindParam(':delivery_address',$delivery_address,PDO::PARAM_STR);
                       $run_pending->bindParam(':product_seller',$seller,PDO::PARAM_STR);
                       $run_pending->execute();

                        if($run_pending==true)
                        {
                            $delete_cart = "DELETE from cart where customer_email=:customer_email";
                            $run_delete=$pdo->prepare($delete_cart);
                            $run_delete->bindParam(':customer_email',$customer_email,PDO::PARAM_STR);
                            $run_delete->execute();



                        }
                    }

                }

            }





            $result='';
            if($run_delete==true)
            {
              /*===================================================================================*/

              $query_mail="SELECT * FROM pending_orders WHERE invoice_no=:invoice_no";
              $run_mail=$pdo->prepare($query_mail);
              $run_mail->bindParam(':invoice_no',$invoice_number,PDO::PARAM_INT);
              $run_mail->execute();
              $rows=$run_mail->fetchAll(PDO::FETCH_ASSOC);
              $total_price=0;
              foreach($rows as $row)
              {
                  $product_codes=$row['product_code'];
                  $product_titles=$row['product_title'];
                  $product_quantitys=$row['qty'];
                  $due_amounts=$row['due_amount'];
                  $order_date=$row['order_date'];
                  $order_status=$row['order_status'];

              }

              $query_add="SELECT * FROM customers WHERE customer_email=:customer_email";
              $run_add=$pdo->prepare($query_add);
              $run_add->bindParam(':customer_email',$customer_email,PDO::PARAM_STR);
              $run_add->execute();
              $row=$run_add->fetchAll(PDO::FETCH_ASSOC);
              foreach($row as $add)
              {
                $customer_name=$add['customer_fname'].' '.$add['customer_fname'];
                $customer_add=$add['customer_address'].', '.$add['customer_city'].', '.$add['customer_country'].', '.$add['customer_pincode'];
                $customer_contact=$add['customer_contact'];
              }




            // Load Composer's autoloader



            require 'STORE\shop\phpmail\PHPMailerAutoload.php';

            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);


                //Server settings
                                                       // Enable verbose debug output
                $mail->isSMTP();                                            // Set mailer to use SMTP
                $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
                $mail->SMTPAuth   = true;


                // Enable SMTP authentication
               $mail->Username   = 'tuanishstore@gmail.com';          // SMTP username
                $mail->Password   = '@tuanish123';                        // SMTP password
                $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
                $mail->Port       = 587;                                         // TCP port to connect to

                //Recipients
                $mail->setFrom('tuanishstore@gmail.com', 'Tuanish Store');
                $mail->addAddress($customer_email);

                $mail->AddEmbeddedImage('logo1.jpeg','logoimg');

                $mail->isHTML(true);
                $mail->Subject = 'Order Invoice Tuanish Store';
                $mail->Body    = '
                                    <div class="email-box" style="position:relative;top:0px;left:0px;background:white;padding:0px 30px;font-family:arial;">
                                    <div align="center"><img src="cid:logoimg" style="height:50px;width:50px;"></div>
                                    <h2 align="center">Order Confirmation</h2>
                                    <div class="message-info" style="position:relative;margin:0px;">
                                    <p style="font-weight:bold">Hello '.$customer_name.',</p>
                                    <p>Thank you for your Online Order! Your order on date '.$order_date.' has been submitted and will be processed as sson as possible.</p>
                                    </div>
                                    <div class="order-number" style="position:relative;background:#f4f4f4;padding:25px;text-align:center;">
                                        <p>Invoice ID :<b>'.$invoice_number.'</b></p>
                                        <p>Status :<b>'.$order_status.'</b></p>
                                    </div>




                                    <div class="total" style="position:relative;display:flex;flex-direction:column;padding:10px 30px;">
                                            <span style="position:relative;text-decoration: none;color:#1a1a1a; width:100%;padding:5px 0px;">
                                            <a style="">Total MRP</a><a class="right" style="position:relative;float:right;">'.$total.'</a></span>
                                            </a></b></span>
                                        </div>


                                        <div class="shipping" style="color:#1a1a1a;">
                                            <p><b>Shipping Address</b><br>
                                           '.$customer_add.'<br>
                                            Phone: <b>'.$customer_contact.'</b></p>
                                        </div>

                                        <div class="payment_method">
                                        <p><b>Payment Method</b><br>
                                        Cash on Delivery</p>
                                        </div><br><br>

                                        <p align="center" style="font-size:20px;font-weight:bold">Thank you for shopping with us</p>
                                        <br><br><br>
                                        <div class="suoport">
                                        You can check the status of your order at any time on our <a href="">Order History Page.</a><br><br>
                                        We welcome you to our store at any time. If you need assistance or have any questions, please email us at <a href="">srijan.singh.1232@gmail.com</a> or call 80849506. We are happy to help you.

                                        Sincerely,
                                        Tuanish Store
                                        tuanishstore.com
                                        </div>
                                        <br><br>
                                        <div class="footer" style="position:relative;border-top:1px solid #1a1a1a;background:#f2f2f2;font-weight:normal;">
                                            <h3 align="center">
                                                &copy; Tuanish Store <br>
                                                tuanishstore.com, prayagraj, Uttar Pradesh,India
                                            </h3>
                                        </div>
                                    </div>
                                    </div>


                                    ';















                if($mail->send())
                {
                header("Location: indexs.php?order&orders=$invoice_number");
                exit();
                }
             else {
                $result= "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }


            }




            /*=================================================================================*/



        }


?>
