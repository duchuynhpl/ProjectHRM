<?php
require_once('../database/dbhelper.php');
?>

<?php
require('../database/connect.php');

$user = $_SESSION['users'];

?>

<?php
if ($user['idcv']!=1 && $user['idcv']!=2 && $user['idcv']!=3 && $user['idcv']!=4) {
    echo '<script language="javascript">
                alert("Bạn không có quyền truy cập trang này"); 
                window.location = "/../login/login.php";
                 </script>';
	include 'checkadmin/show_error.php';
	exit();
}
?>

<?php
    if (isset($_GET['maban'])) {
        $maban = $_GET['maban'];
    }
    $sql = "SELECT * FROM test_table WHERE maban='$maban'";
    $query = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($query);

    if(isset($_POST['submit'])){
        $trangthai = $_POST['trangthai'];
    
       
        $sql = "UPDATE test_table SET trangthai ='$trangthai' WHERE maban=$maban";
        $query = mysqli_query($con, $sql);
        if($query){
            echo '<script language="javascript">
                alert("Đã thay đổi thành công"); 
                window.location = "../table/";
                 </script>';
        }
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
                <a href="/admin/salary/index.php" class="active">
                    <i class='bx bx-notepad'></i>
                    <span class="links_name">Quản lý lương</span>
                </a>
                <span class="tooltip">Quản lý lương</span>
            </li>
            <li>
                <a href="/admin/groups">
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
            <div class="center">
                <div class="container">
                    <div class="row">
                     <div class="col-sm-8 offset-sm-2">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center">Thông tin <?php echo $data['tenban']; ?></h3>
                            </div>
                            <div class="card-body">   
                                <form method='POST' action="">
                                    <div class="form-group row">
                                    <label class="col-sm-5 col-form-label" for="work">Trạng thái</label>
                                    <div class="col-sm-7">
                                        <select name="trangthai" id="" class="form-control">
                                            <option value="Chưa có khách">Chưa có khách</option>
                                            <option value="Đang hoạt động">Đang hoạt động</option>
                                            <option value="⚠️Bảo trì⚠️">⚠️Bảo trì⚠️</option>
                                        </select>
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-sm-5 offset-sm-4">
                                            <button type="submit" class="btn btn-primary" name="submit" value="Sign up">Lưu</button>
                                        </div>
                                    </div>
                                </form>
                            </div>     
                        </div>    
                    </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</body>

</html>