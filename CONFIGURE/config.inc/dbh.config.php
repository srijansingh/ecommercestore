<?php

#start

$host='localhost';
$dbname='atuanishsecure';
$user='root';
$password='1230';

$dsn="mysql: host=$host;dbname=$dbname";

$pdo=new PDO($dsn,$user,$password);


#end

$conn=mysqli_connect($host,$user,$password,$dbname);
