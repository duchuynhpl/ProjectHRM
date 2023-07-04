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
    if (isset($_GET['id_faculty'])) {
        $idfaculty = $_GET['id_faculty'];
    }
    $sql = "SELECT * FROM user,work WHERE user.idcv=work.idcv AND id_faculty='$idfaculty'";
    $query = mysqli_query($con, $sql);
?>

<?php
$error = [];
if(isset($_POST['submit'])){
    $faculty = $_POST['faculty'];
    $iduser = $_GET['id_user'];

    if(empty($faculty)){
        $error['faculty'] = 'Chưa nhập tên nhóm';
    }
    if(empty($error)){
        $sql = "UPDATE user SET id_faculty = '$faculty' WHERE id= 1 ";
        $query = mysqli_query($con, $sql);
        if($query){
            echo '<script language="javascript">
                alert("chuyển ban thành công"); 
                window.location = "../groups/";
                 </script>';
        }
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
        <?php $sql = "SELECT * FROM faculty WHERE idfaculty ='$idfaculty'";
            $result = mysqli_query($con, $sql);
            $data = mysqli_fetch_assoc($result);
        ?>
        <div class="title_list" style="font-weight: bold;">Danh sách nhân viên Phòng ban <?php echo $data['namefaculty'] ?></div>
        <div class="center">
            <div class="container">
                <div class="row">
                    <table class="table table-striped text-center align-middle">
                        <thead class="blue">
                            <tr>
                                <th>Mã CB</th>
                                <th>Họ và tên</th>
                                <th>Giới tính</th>
                                <th>SĐT</th>
                                <th>Chức vụ</th>
                                <th>Chuyên ngành</th>
                                <th>Học vấn</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while($listGroup = mysqli_fetch_assoc($query)){
                            echo '<tr>
                            <th> '.$listGroup['employee_id'].'</th>
                            <th> '.$listGroup['hoten'].'</th>
                            <th> '.$listGroup['sex'].'</th>
                            <th> '.$listGroup['phone'].'</th>
                            <th> '.$listGroup['tencv'].'</th>
                            <th> '.$listGroup['speciality'].'</th>
                            <th> '.$listGroup['degree'].'</th>
                            <th>
                                <a href="trip.php?id_user=' . $listGroup['id'] . '">
                                    <button class="btn btn-primary">Quá trình công tác</button>
                                </a>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#modal1" name="iduser">chuyển ban</button>
                            </th>
                            </tr>';
                            echo '<div id="modal1" class="modal fade" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header text-center d-block">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h2 class="modal-title">
                                            <i class="fas fa-lock"></i> chuyển ban
                                        </h2>
                                    </div>
                                <div class="modal-body">
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label for="usernameInput">
                                                <i class="fas fa-user"></i> chuyển ban
                                            </label>
                                            <select name="faculty" id="faculty" class="form-control">
                                                <option value="1">Công nghệ thông tin</option>
                                                <option value="2">Công nghệ phần mềm</option>
                                                <option value="3">Hệ thống thông tin</option>
                                                <option value="4">Học máy tính</option>
                                                <option value="5">Máy tính và truyền thông</option>
                                                <option value="6">Truyền thông đa phương tiện</option>
                                            </select>
                                            <span style="color:red;"> <?php echo (isset($error["faculty"]))?$error["faculty"]:""  ?></span>
                                        </div>
            
                                        <button  type="submit"class="btn btn-danger btn-block" name="submit">Chuyển</button>
                                    </form>
                                </div>  
                            </div>
                        </div>   ';
                        } ?>
                        </tbody>
                    </table>
                </div>  
            </div>
            
        </div>
    </div>
</body>

</html>