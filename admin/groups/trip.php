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
    if (isset($_GET['id_user'])) {
        $iduser = $_GET['id_user'];
    }
    $sql = "SELECT * FROM business WHERE id_user='$iduser'";
    $query = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CT466-12</title>
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="./css/index.css">
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
        <div class="title_list" style="font-weight: bold;">Quá trình công tác</div>
        <div class="center">
            <!-- <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tên nhân viên:</label>
                <div class="col-sm-5">
                <input type="text" class="form-control" value="Abc" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nội dung công tác:</label>
                <div class="col-sm-5">
                <input type="text" class="form-control" value="Abc">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Ngày đi:</label>
                <div class="col-sm-5">
                <input type="date" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Ngày về:</label>
                <div class="col-sm-5">
                <input type="date" class="form-control">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nơi công tác:</label>
                <div class="col-sm-5">
                <input type="text" class="form-control">
                </div>
            </div>

            <div class="col-sm-5 offset-sm-5">
                <button type="submit" class="btn btn-success" name="submit" value="Sign up">Thêm công tác</button>
                <br>
            </div> -->
            <br> 
            <?php $sql = "SELECT * FROM business,user WHERE business.id_user=user.id AND id_user ='$iduser'";
            $tripList = executeResult($sql);
            ?>      
            <div class="container">
                <div class="row">
                    <table class="table table-striped text-center align-middle">
                        <thead class="blue">
                            <tr>
                                <th>Mã CB</th>
                                <th>Họ và tên</th>
                                <th>Nội dung công tác</th>
                                <th>Nơi đi</th>
                                <th>Ngày đi</th>
                                <th>Ngày về</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($tripList as $trip) {
                            echo '
                            <tr>
                                <th>'.$trip['employee_id'].'</th>
                                <th>'.$trip['hoten'].'</th>
                                <th>'.$trip['content'].'</th>
                                <th>'.$trip['addressbn'].'</th>
                                <th>'.$trip['departuredate'].'</th>
                                <th>'.$trip['returndate'].'</th>
                                <th>'.$trip['statustrip'].'</th>
                            </tr>';
                        }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>