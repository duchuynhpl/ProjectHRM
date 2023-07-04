<?php
require_once('../database/dbhelper.php');
?>

<?php
require('../../login/connect.php');

$user = $_SESSION['users'];

function generateEmployeeID($suffix_length) {
    $prefix = 'KT'; 
    $max_number = pow(10, $suffix_length) - 1; 
    $random_number = rand(0, $max_number); 
    $suffix = str_pad($random_number, $suffix_length); 
    $kt_id = $prefix . $suffix; 
    return $kt_id; 
}

$kt_id = generateEmployeeID(6);

?>

<?php
if(isset($_POST['submit'])){
    $kt_id = generateEmployeeID(6);
    $iduser = $_POST['id_user'];
    $decision_number = $_POST['decision_number'];
    $decision_day = $_POST['decision_day'];
    $name_reward = $_POST['name_reward'];
    $type_reward = $_POST['type_reward'];
    $content_reward = $_POST['content_reward'];
    $statuskt = $_POST['statuskt'];

    $sql = "INSERT INTO reward(code_reward,decision_number,decision_day,name_reward,id_user,type_reward,content_reward,statuskt) 
    values ('$kt_id','$decision_number','$decision_day','$name_reward','$iduser','$type_reward','$content_reward','$statuskt')";
    $query = mysqli_query($con, $sql);
    if($query){
        echo '<script language="javascript">
            alert("Thêm khen thưởng thành công"); 
            window.location = "/admin/reward/reward.php";
             </script>';
    }

    }
?>

<?php
if ($user['idcv']!=1) {
    echo '<script language="javascript">
                alert("Bạn không có quyền truy cập trang này"); 
                window.location = "/login/login.php";
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
    <link rel="stylesheet" href="./css/reward.css">
    <script src="../js/sidebar.js"></script>
    <!--Box Icon CSS-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"/>	
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
                <a href="/admin/reward" class="active">
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
        <div class="text" style="font-weight: bold;">Thêm khen thưởng</div>
            <div class="center">
                <div class="container">
                <form method="POST">
                <label for="faculty_select">Chọn khoa:</label>
                <select name="faculty_select" id="faculty_select" class="form-control">
                    <option value="1">Công nghệ thông tin</option>
                    <option value="2">Công nghệ phần mềm</option>
                    <option value="3">Hệ thống thông tin</option>
                    <option value="4">Học máy tính</option>
                    <option value="5">Máy tính và truyền thông</option>
                    <option value="6">Truyền thông đa phương tiện</option>
                </select>
                <br>
                <div class="row">
                    <div class="col-sm-5 offset-sm-5">
                        <button type="submit" class="btn btn-primary" value="Sign up">Chọn</button>                            
                    </div>
                </div>
            </form>
            <br>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $faculty_id = $_POST["faculty_select"];
                $sql = "SELECT id,hoten FROM user WHERE id_faculty = $faculty_id;";
                $query = mysqli_query($con, $sql);
                echo '<div class="row">
                <div class="col-sm-8 offset-sm-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Khen thưởng</h3>
                    </div>
                    <div class="card-body">
                        <form id="signupForm" action="" method="POST" class="form-horizontal" enctype="multipart/form-data">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="kt_id">Mã KT:</label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" name="kt_id" id="kt_id" value="'.$kt_id.'" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Chọn nhân viên:</label>
                            <div class="col-sm-7">
                            <select name="id_user" id="id_user" class="form-control">';
                            while ($row = mysqli_fetch_assoc($query)) {
                                echo "
                                    <option value=" . $row['id'] . ">" . $row['hoten'] . "</option>";
                            }
                            echo '
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="decision_number">Số quyết định:</label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" name="decision_number" id="decision_number" placeholder="Nhập số quyết định">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Ngày quyết định:</label>
                            <div class="col-sm-7">
                            <input type="date" class="form-control" name="decision_day">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="name_reward">Tên khen thưởng:</label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" name="name_reward" id="name_reward" placeholder="Nhập tên khen thưởng">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="type_reward">Loại khen thưởng :</label>
                            <div class="col-sm-7">
                            <select name="type_reward" id="type_reward" class="form-control">
                                <option value="Khen thưởng theo thành tích">Khen thưởng theo thành tích</option>
                                <option value="Khen thưởng theo đợt">Khen thưởng theo đợt</option>
                                <option value="Khen thưởng đột xuất">Khen thưởng đột xuất</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="content_reward">Nội dung khen thưởng:</label>
                            <div class="col-sm-7">
                            <textarea class="form-control" rows="4" cols="52" id="content_reward" name="content_reward"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="statuskt">Trạng thái:</label>
                            <div class="col-sm-7">
                            <select name="statuskt" id="statuskt" class="form-control">
                                <option value="Xem xét">Xem xét</option>
                                <option value="Đã xét">Đã xét</option>
                            </select>
                            </div>
                        </div>

                        <div class="col-sm-5 offset-sm-5">
                            <button type="submit" class="btn btn-success" name="submit" value="Sign up">Thêm khen thưởng</button>
                            <br>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>';
            }
        ?>
                </div>   
            </div>
        </div>
    </div>
</body>

</html>