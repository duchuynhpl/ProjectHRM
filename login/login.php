<?php require('connect.php') ?>
<?php
require_once('../database/dbhelper.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CT466-12</title>

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="login.css">

</head>
<body>
    <div class="container">
        <div class="titles">
            <img src="../img/vnpt.png" alt="" class="logo">
            <h4 class="text">HỆ THỐNG QUẢN LÝ NHÂN SỰ</h4>
        </div>
        <div class="forms">
            <div class="form login">
                <span class="title">Đăng nhập</span>
                <form action="" method="POST">
                    <div class="input-field">
                        <input type="text" name="username" placeholder="Vui lòng nhập tài khoản">
                        <i class="uil uil-user"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" class="password" placeholder="Vui lòng nhập mật khẩu">
                        <i class="uil uil-lock"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="checkbox-text">
                        <a href="#" class="text">Quên mật khẩu?</a>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="submit" value="Đăng nhập">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php 
    if(isset($_POST['submit'])){
        if(empty($_POST['username']) or empty($_POST['password'])){
            echo '<script language="javascript">
            alert("Không được để trống tài khoản hoặc mật khẩu!"); 
             </script>';
            // echo '<p style="color:red"Vui lòng không để trống</p>';
        } else{
            $username = $_POST['username'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM user,work WHERE username='$username' AND password='$password' AND user.idcv=work.idcv";
            // $con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
            $query = mysqli_query($con, $sql);
            $data = mysqli_fetch_assoc($query);
            $num = mysqli_num_rows($query);
            if($num == 0){
                echo '<script language="javascript">
                alert("Tên đăng nhập hoặc mật khẩu sai!"); 
                 </script>';
                // echo '<p style="color:red"Tên đăng nhập hoặc mật khẩu sai</p>';
            } else {
                $_SESSION['users'] = $data;
                header('location:../admin/dashboard.php');
            }
        }
    }
?>

    <script src="login.js"></script>
</body>
</html>