<?php
require_once('../database/dbhelper.php');
?>

<?php
require('../database/connect.php');

$user = $_SESSION['users'];

function generateEmployeeID($suffix_length) {
    $prefix = 'L'; 
    $max_number = pow(10, $suffix_length) - 1; 
    $random_number = rand(0, $max_number); 
    $suffix = str_pad($random_number, $suffix_length); 
    $salary_id = $prefix . $suffix; 
    return $salary_id; 
}


$salary_id = generateEmployeeID(6);
?>

<?php
if ($user['idcv']!=1) {
    echo '<script language="javascript">
                alert("Bạn không có quyền truy cập trang này"); 
                window.location = "/../login/login.php";
                 </script>';
	include 'checkadmin/show_error.php';
	exit();
}
?>


<?php

if(isset($_POST['submit'])){
    $salary_id = generateEmployeeID(6);
    $iduser = $_POST['faculty_select'];
    $payday = $_POST['payday'];
    $workday = $_POST['workday'];
    $monthsalary = $_POST['monthsalary'];
    $allowance = $_POST['allowance'];
    $salaryadvance = $_POST['salaryadvance'];
    $realsalary = $_POST['realsalary'];
    $timepayday = $_POST['timepayday'];

    $sql = "INSERT INTO salary(code_salary,payday,workday,monthsalary,allowance,salaryadvance,realsalary,timepayday,id_user) 
    values ('$salary_id','$payday','$workday','$monthsalary','$allowance','$salaryadvance','$realsalary','$timepayday','$iduser')";
    $query = mysqli_query($con, $sql);
    if($query){
        echo '<script language="javascript">
            alert("Thêm lương thành công"); 
            window.location = "/admin/salary";
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
    <link rel="stylesheet" href="css/index.css">

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
        <div class="text" style="font-weight: bold;">Thêm lương</div>
            <div class="center">
                <div class="container">
                    <form method="POST">
                        <label for="faculty_select">Chọn Phòng ban:</label>
                        <select name="faculty_select" id="faculty_select" class="form-control">
                            <option value="1">Ban lãnh đạo</option>
                            <option value="2">Ban nhân sự</option>
                            <option value="3">Ban kế toán</option>
                            <option value="4">Ban văn phòng</option>
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
                    
                    
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $faculty_id = $_POST["faculty_select"];
                        $sql = "SELECT id,hoten FROM user WHERE id_faculty = $faculty_id;";
                        $query = mysqli_query($con, $sql);
                        echo '<form method="POST">
                        <label class="col-sm-4 col-form-label">Mã lương</label>
                        <input type="text" class="form-control" name="salary_id" value="' . $salary_id . '" readonly>
                        <label>Chọn nhân viên: </label><br>';
                        echo "<select name='faculty_select' id='faculty_select' class='form-control'>";
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "
                            <option value=".$row['id'].">".$row['hoten']."</option>";
                        }
                        echo "</select>
                        <label class='col-form-label'>Lương ngày:</label>
                        <input type='text' class='form-control' name='payday' placeholder='Số tiền lương 1 ngày' />
                        <label class='col-form-label'>Ngày công:</label>
                        <input type='text' class='form-control' name='workday' placeholder='Ngày công đã làm' />
                        <label class='col-form-label'>Lương tháng:</label>
                        <input type='text' class='form-control' name='monthsalary' placeholder='Số tiền lương 1 tháng' />
                        <label class='col-form-label'>Phụ cấp:</label>
                        <input type='text' class='form-control' name='allowance' placeholder='Số tiền phụ cấp thêm' />
                        <label class='col-form-label'>Tam ứng:</label>
                        <input type='text' class='form-control' name='salaryadvance' placeholder='Ứng lương trước' />
                        <label class='col-form-label'>Thực lãnh:</label>
                        <input type='text' class='form-control' name='realsalary' placeholder='Số tiền lãnh lương' />
                        <label class='col-form-label'>Ngày chấm:</label>
                        <input type='date' class='form-control' name='timepayday' placeholder='Ngày chấm lương' />
                        <br>
                        <div class='row'>
                            <div class='col-sm-5 offset-sm-5'>
                                <button type='submit' name='submit' class='btn btn-primary' value='Sign up'>Thêm lương</button>                            
                            </div>
                        </div>
                        <br>
                        </form>";
                      }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
</body>

</html>