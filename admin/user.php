<?php
require_once('../database/dbhelper.php');
?>

<?php
require('../login/connect.php');

$user = $_SESSION['users'];

?>

<?php
if ($user['idcv']!=1) {
    echo '<script language="javascript">
                alert("Bạn không có quyền truy cập trang này"); 
                window.location = "../login/login.php";
                 </script>';
	include 'checkadmin/show_error.php';
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CT466-12</title>
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/user.css">

    <!--Box Icon CSS-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"/>	
</head>
<body>
<?php require "layout/sidebar.php"; ?>

    <div class="home_content">
        <div class="text" style="font-weight: bold;">Danh sách nhân viên</div>

        <div class="center">
            <div class="container">
                <div class="row">
                    <a href="add.php">
                        <button class=" btn btn-success" style="margin-bottom:20px">Thêm nhân viên</button>
                    </a>
                    <table class="table table-striped">
                        <thead class="blue">
                            <tr>
                                <th>ID</th>
                                <th>Mã CB</th>
                                <th>Họ và tên</th>
                                <th>Chức vụ</th>
                                <th>SĐT</th>
                                <th>Email</th>
                                <th>Địa chỉ</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            try {

                                if (isset($_GET['page'])) {
                                    $page = $_GET['page'];
                                } else {
                                    $page = 1;
                                }
                                $limit = 5;
                                $start = ($page - 1) * $limit;
                                
                                // Lấy danh sách user
                                $sql = "SELECT * FROM user,work where user.idcv=work.idcv ORDER BY id ASC limit $start,$limit";
                                $userList = executeResult($sql);
                                $stt = 1;
                                foreach ($userList as $user) {
                                    echo ' <tr>
                                    <th> '.$user['id'].'</th>
                                    <th> '.$user['employee_id'].'</th>
                                    <th> '.$user['hoten'].'</th>
                                    <th> '.$user['tencv'].'</th>
                                    <th> '.$user['phone'].'</th>
                                    <th> '.$user['email'].'</th>
                                    <th> '.$user['address'].'</th>
                                    <th>
                                        <a href="delete.php?id=' . $user['id'] . '">
                                            <button class="btn btn-danger">Xoá</button>
                                        </a>   
                                        <a href="edit.php?id=' . $user['id'] . '">
                                        <button class=" btn btn-warning">Sửa</button> 
                                        </a> 
                                        <a href="profile.php?id=' . $user['id'] . '">
                                        <button class=" btn btn-success">Xem chi tiết</button> 
                                        </a>
                                    </th>
                                    </tr>';
                                }
                            } catch (Exception $e) {
                                die("Lỗi thực thi sql: " . $e->getMessage());
                            } 
                                ?>
                        </tbody>
                    </table>
                    <ui class="pagination">
                    <?php
                    $sql = 'SELECT * FROM user';
                    $query = mysqli_query($con, $sql);
                    $current_page = 0;
                    if (mysqli_num_rows($query)) {
                        $numrow = mysqli_num_rows($query);
                        $current_page = ceil($numrow / 5);
                    }
                    for ($i = 1; $i <= $current_page; $i++) {
                        // Nếu là trang hiện tại thì hiển thị thẻ span
                        // ngược lại hiển thị thẻ a
                        if ($i == $current_page) {
                            echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                        } else {
                            echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                        }
                    }
                    ?>
                    </ui>
                </div>
            </div>
        </div>
    </div>
</body>

</html>