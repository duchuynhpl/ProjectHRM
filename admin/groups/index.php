<?php
require_once('../../database/dbhelper.php');
?>

<?php
require('../../login/connect.php');

$user = $_SESSION['users'];

?>

<?php
$error = [];
if(isset($_POST['submit'])){
    $work = $_POST['work'];

    if(empty($work)){
        $error['workcv'] = 'Chưa nhập tên nhóm';
    }
    if(empty($error)){
        $sql = "INSERT INTO work(tencv) values ('$work')";
        $query = mysqli_query($con, $sql);
        if($query){
            echo '<script language="javascript">
                alert("Thêm nhóm mới thành công"); 
                window.location = "../groups/";
                 </script>';
        }
    }

}
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
    <link rel="stylesheet" href="../css/sidebar.css">
    <script src="../js/sidebar.js"></script>

 <!--Box Icon CSS-->
 <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>	
</head>
<body>
<div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <img src="../../img/vnpt.png" alt="" style="height: 35px; width:48px">
                <div class="logo_text">
                    <div class="logo_name">Quản lý nhân sự</div>
                    <div class="logo_ver">Version 0.1</div>
                </div>
            </div>
            <i class='bx bx-menu' id="btn" ></i>
        </div>
        <ul class="nav_list">
            <li>
                <a href="#">
                    <i class='bx bx-search' ></i>
                    <input type="text" placeholder="Tìm kiếm...">
                </a>
                <!-- <span class="tooltip">Quản trị viên</span> -->
            </li>
            <li>
                <a href="/admin/dashboard.php">
                    <i class='bx bx-pie-chart-alt'></i>
                    <span class="links_name">Tổng quát</span>
                </a>
                <span class="tooltip">Tổng quát</span>
            </li>
            <li>
                <a href="/admin/user.php">
                    <i class='bx bxs-user'></i>
                    <span class="links_name">nhân viên</span>
                </a>
                <span class="tooltip">nhân viên</span>
            </li>
            <li>
                <a href="/admin/salary/index.php">
                    <i class='bx bx-notepad'></i>
                    <span class="links_name">Quản lý lương</span>
                </a>
                <span class="tooltip">Quản lý lương</span>
            </li>
            <li>
                <a href="/admin/groups" class="active">
                    <i class='bx bxs-group'></i>
                    <span class="links_name">Nhóm Phòng ban</span>
                </a>
                <span class="tooltip">Nhóm Phòng ban</span>
            </li>
            <li>
                <a href="/admin/trip/index.php">
                    <i class='bx bx-notepad'></i>
                    <span class="links_name">Quản lý công tác</span>
                </a>
                <span class="tooltip">Quản lý công tác</span>
            </li>
            <li>
                <a href="/admin/reward">
                    <i class='bx bx-gift'></i>
                    <span class="links_name">Khen thưởng-kỷ luật</span>
                </a>
                <span class="tooltip">Khen thưởng-kỷ luật</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-cog'></i>
                    <span class="links_name">Cài đặt</span>
                </a>
                <span class="tooltip">Cài đặt</span>
            </li>
        </ul>
        <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                    <img src="../upload/profile.png" alt=""> 
                    <div class="name_job">
                        <div class="name"><?php echo $user['hoten']; ?></div>
                        <div class="job"><?php echo $user['tencv']; ?></div>
                    </div>
                </div>
                <a href="/login/logout.php">
                <i class='bx bx-log-out' id="log_out"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="home_content">
        <div class="text" style="font-weight: bold;">Danh sách Phòng ban</div>

        <div class="center">
            <div class="container">
                <div class="row">
                <a href="#" class="btn btn-success" style="margin-bottom:20px" data-toggle="modal" data-target="#modal1">Thêm Phòng ban</a>
                    <table class="table table-striped text-center align-middle">
                        <thead class="blue">
                            <tr>
                                <th>ID</th>
                                <th>Tên Phòng ban</th>
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
                                $sql = "SELECT * FROM faculty ORDER BY idfaculty ASC limit $start,$limit";
                                $groupList = executeResult($sql);
                                $stt = 1;
                                foreach ($groupList as $group) {
                                    echo ' <tr>
                                    <th> '.$group['idfaculty'].'</th>
                                    <th> '.$group['namefaculty'].'</th>
                                    <th>
                                        <a href="list.php?id_faculty=' . $group['idfaculty'] . '">
                                            <button class="btn btn-primary">Danh sách nhân viên</button>
                                        </a> 
                                        <a href="delete.php?idcv=' . $group['idfaculty'] . '">
                                            <button class="btn btn-danger">Xoá</button>
                                        </a> 
                                        <a href="edit.php?idcv=' . $group['idfaculty'] . '">
                                        <button class=" btn btn-warning">Sửa</button> 
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
                    <div id="modal1" class="modal fade" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header text-center d-block">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h2 class="modal-title">
                                        <i class="fas fa-lock"></i> Thêm Phòng ban mới
                                    </h2>
                                </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="usernameInput">
                                            <i class="fas fa-user"></i> Tên Phòng ban mới
                                        </label>
                                        <input class="form-control" name="work">
                                        <span style="color:red;"> <?php echo (isset($error['workcv']))?$error['workcv']:''  ?></span>
                                    </div>

                                    <button  type="submit"class="btn btn-success btn-block" name="submit">Thêm</button>
                                </form>
                            </div>  
                        </div>
                    </div>   
            </div>
        </div>
    </div>
</body>

</html>