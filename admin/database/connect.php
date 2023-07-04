<?php
$host = "localhost"; //địa chỉ mysql server sẽ kết nối đến
$dbname="test"; //tên database sẽ kết nối đến
$username = "root"; //username để kết nối đến database 
$password = ""; // mật khẩu để kết nối đến database
$con = mysqli_connect($host,$username, $password, $dbname);  // kết nối đến database. $conn gọi là đối tượng kết nối.
session_start();

?>