<?php
require_once('../database/dbhelper.php');
?>

<?php
require('../../login/connect.php');

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

<?php
if(isset($_POST['submit'])){
    $iduser = $_POST['id_user'];
    $faculty_id = $_POST['facultyid'];
    $content = $_POST['content'];
    $addressbn = $_POST['addressbn'];
    $departuredate = $_POST['departuredate'];
    $returndate = $_POST['returndate'];
    $statustrip = $_POST['statustrip'];

    $sql = "INSERT INTO business(content,addressbn,departuredate,returndate,id_user,id_faculty,statustrip) 
    values ('$content','$addressbn','$departuredate','$returndate','$iduser','$faculty_id','$statustrip')";
    $query = mysqli_query($con, $sql);
    if($query){
        echo '<script language="javascript">
            alert("Thêm công tác thành công"); 
            window.location = "/admin/trip";
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
    <link rel="stylesheet" href="css/reg.css">
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
                <a href="/admin/trip/index.php" class="active">
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
                        <h3 class="text-center">Thêm lịch công tác</h3>
                    </div>
                    <div class="card-body">
                        <form id="signupForm" action="add.php" method="POST" class="form-horizontal" enctype="multipart/form-data">

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
                            <label class="col-sm-3 col-form-label" for="content">Nội dung công tác:</label>
                            <div class="col-sm-7">
                            <textarea rows="4" cols="46" id="content" name="content"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Ngày đi:</label>
                            <div class="col-sm-7">
                            <input type="date" class="form-control" name="departuredate">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Ngày về:</label>
                            <div class="col-sm-7">
                            <input type="date" class="form-control" name="returndate">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="addressbn">Nơi công tác:</label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" name="addressbn" id="addressbn" placeholder="Nhập nơi công tác">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="statustrip">Nơi công tác:</label>
                            <div class="col-sm-7">
                                <select name="statustrip" id="statustrip" class="form-control">
                                    <option value="Chuẩn bị đi">Chuẩn bị đi</option>
                                    <option value="Đang đi">Đang đi</option>
                                    <option value="Đã đi">Đã đi</option>
                                </select>                            
                            </div>
                        </div>

                        <div class="col-sm-5 offset-sm-5">
                            <input value='.$faculty_id.' name="facultyid" hidden>
                            <button type="submit" class="btn btn-success" name="submit" value="Sign up">Thêm công tác</button>
                            <br>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>';
            }            
            ?>  
                <!-- <div class="row">
                    <div class="col-sm-8 offset-sm-2">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center">Thêm lịch công tác</h3>
                            </div>
                            <div class="card-body">
                                <form id="signupForm" action="add.php" method="POST" class="form-horizontal" enctype="multipart/form-data">

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Chọn nhân viên:</label>
                                    <div class="col-sm-7">
                                    <input type="text" class="form-control" value="Abc">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nội dung công tác:</label>
                                    <div class="col-sm-7">
                                    <input type="text" class="form-control" value="Abc">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Ngày đi:</label>
                                    <div class="col-sm-7">
                                    <input type="date" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Ngày về:</label>
                                    <div class="col-sm-7">
                                    <input type="date" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nơi công tác:</label>
                                    <div class="col-sm-7">
                                    <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-5 offset-sm-5">
                                    <button type="submit" class="btn btn-success" name="submit" value="Sign up">Thêm công tác</button>
                                    <br>
                                </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</body>

</html>