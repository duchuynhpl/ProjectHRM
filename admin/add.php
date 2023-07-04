<?php
require_once('../database/dbhelper.php');
?>

<?php
require('../login/connect.php');

$user = $_SESSION['users'];
function generateEmployeeID($suffix_length) {
    $prefix = 'CTUCB'; 
    $max_number = pow(10, $suffix_length) - 1; 
    $random_number = rand(0, $max_number); 
    $suffix = str_pad($random_number, $suffix_length); 
    $employee_id = $prefix . $suffix; 
    return $employee_id; 
}


$employee_id = generateEmployeeID(6);

$error = [];
if(isset($_POST['submit'])){
    $employee_id = generateEmployeeID(6);
    $name = $_POST['fullname'];
    $work = $_POST['workcv'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $speciality = $_POST['speciality'];
    $cccd = $_POST['cccd'];
    $datecccd = $_POST['datecccd'];
    $sex = $_POST['sex'];
    $birthday = $_POST['birthday'];
    $placebirth = $_POST['placebirth'];
    $degree = $_POST['degree'];
    $level = $_POST['level'];
    $national = $_POST['national'];
    $religion = $_POST['religion'];
    $nation = $_POST['nation'];
    $typeemployee = $_POST['typeemployee'];
    $uploadfile = basename($_FILES["file_upload"]["name"]);
    $status = $_POST['status'];
    $faculty_id = $_POST['faculty_id'];

    if(empty($name)){
        $error['fullname'] = 'Chưa nhập tên';
    }
    if(empty($email)){
        $error['email'] = 'Chưa nhập email';
    }
    if(empty($phone)){
        $error['phone'] = 'Chưa nhập số điện thoại';
    }
    if(empty($address)){
        $error['address'] = 'Chưa nhập địa chỉ';
    }
    if(empty($cccd)){
        $error['cccd'] = 'Chưa nhập CCCD';
    }
    if(empty($datecccd)){
        $error['datecccd'] = 'Chưa nhập ngày cấp CCCD';
    }
    if(empty($birthday)){
        $error['birthday'] = 'Chưa nhập ngày sinh';
    }
    if(empty($placebirth)){
        $error['placebirth'] = 'Chưa nhập nơi sinh';
    }
    if(empty($degree)){
        $error['degree'] = 'Chưa nhập bằng cấp';
    }
    if(empty($national)){
        $error['national'] = 'Chưa nhập quốc tịch';
    }
    if(empty($error)){
        $sql = "INSERT INTO user(employee_id,hoten,phone,email,address,idcv,speciality,cccd,datecccd,sex,birthday,placebirth,degree,level,national,religion,nation,avatar,typeemployee,status,id_faculty) values
         ('$employee_id','$name','$phone','$email','$address','$work','$speciality','$cccd','$datecccd','$sex','$birthday','$placebirth','$degree','$level','$national','$religion','$nation','$uploadfile','$typeemployee','$status','$faculty_id')";
        $query = mysqli_query($con, $sql);
        if($query){
            echo '<script language="javascript">
                alert("Cấp tài khoản thành công"); 
                window.location = "../admin/user.php";
                 </script>';
        }
    } 

    //upload file
    $target_dir = "upload/";
    $target_file = $target_dir . $uploadfile;
    move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file);    

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
    <link rel="stylesheet" href="css/sidebar.css">

    <!--Box Icon CSS-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"/>	
    <link rel="stylesheet" href="css/reg.css">
</head>
<body>
<?php require "layout/sidebar.php"; ?>

    <div class="home_content">
        <div class="center">
            <div class="container">
                <div class="row">
                    <div class="col-sm-11 offset-sm-2" style="position: relative; right: 160px; bottom: 30px;">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center">Cấp tài khoản nhân viên</h3>
                            </div>
                            <div class="card-body">
                                <form id="signupForm" action="add.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Mã nhân viên</label>
                                                <div class="col-sm-8">
                                                <?php
                                                echo '<input type="text" class="form-control" name="employee_id" value="' . $employee_id . '" readonly>';
                                                ?>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Ảnh đại diện</label>
                                                <div class="col-sm-5">
                                                    <input type="file" name="file_upload" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Họ và tên</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="fullname" placeholder="Họ của nhân viên" />
                                                    <div class="error">
                                                        <span> <?php echo (isset($error['fullname']))?$error['fullname']:''  ?></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="work">Chức vụ</label>
                                                <div class="col-sm-8">
                                                    <select name="workcv" id="" class="form-control">
                                                        <?php
                                                        $work = mysqli_query($con, "SELECT * FROM work");
                                                        $work = mysqli_fetch_all($work, MYSQLI_ASSOC);
                                                        foreach($work as $works)
                                                        echo '
                                                        <option value="'.$works['idcv'].'">'.$works['tencv'].'</option>
                                                        ';
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="email">Email</label>
                                                <div class="col-sm-8">
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Hộp thư điện tử" />
                                                    <div class="error">
                                                        <span> <?php echo (isset($error['email']))?$error['email']:''  ?></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="phone">Số điện thoại</label>
                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" />
                                                    <div class="error">
                                                        <span> <?php echo (isset($error['phone']))?$error['phone']:''  ?></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="address">Địa chỉ</label>
                                                <div class="col-sm-8">
                                                    <textarea rows="4" cols="35" id="address" name="address"></textarea>
                                                    <div class="error">
                                                        <span> <?php echo (isset($error['address']))?$error['address']:''  ?></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="speciality">Chuyên môn</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="speciality" name="speciality" placeholder="Chuyên môn" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="typeemployee">Loại nhân viên</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="typeemployee" name="typeemployee" placeholder="Loại nhân viên" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="work">Phòng ban</label>
                                                <div class="col-sm-8">
                                                    <select name="faculty_id" id="" class="form-control">
                                                        <?php
                                                        $faculty = mysqli_query($con, "SELECT * FROM faculty");
                                                        $faculty = mysqli_fetch_all($faculty, MYSQLI_ASSOC);
                                                        foreach($faculty as $facultys)
                                                        echo '
                                                        <option value="'.$facultys['idfaculty'].'">'.$facultys['namefaculty'].'</option>
                                                        ';
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>   
                                        <div class="col-sm-6">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Số CCCD</label>
                                                <div class="col-sm-8">
                                                <input type="text" class="form-control" name="cccd" placeholder="Số CCCD" />
                                                <div class="error">
                                                        <span> <?php echo (isset($error['cccd']))?$error['cccd']:''  ?></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Ngày cấp CCCD</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control" name="datecccd" placeholder="Ngày cấp CCCD" />
                                                    <div class="error">
                                                        <span> <?php echo (isset($error['datecccd']))?$error['datecccd']:''  ?></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="sex">Giới tính</label>
                                                <div class="col-sm-8">
                                                    <select name="sex" id="" class="form-control">
                                                        <option value="Nam">Nam</option>
                                                        <option value="Nữ">Nữ</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="birthday">Ngày sinh</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control" id="birthday" name="birthday" placeholder="Ngày sinh" />
                                                    <div class="error">
                                                        <span> <?php echo (isset($error['birthday']))?$error['birthday']:''  ?></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="placebirth">Nơi sinh</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="placebirth" name="placebirth" placeholder="Nơi sinh" />
                                                    <div class="error">
                                                        <span> <?php echo (isset($error['placebirth']))?$error['placebirth']:''  ?></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="degree">Bằng cấp</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="degree" name="degree" placeholder="Bằng cấp" />
                                                    <div class="error">
                                                        <span> <?php echo (isset($error['degree']))?$error['degree']:''  ?></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="level">Trình độ</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="level" name="level" placeholder="Trình độ" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="national">Quốc tịch</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="national" name="national" placeholder="Quốc tịch" />
                                                    <div class="error">
                                                        <span> <?php echo (isset($error['national']))?$error['national']:''  ?></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="religion">Tôn giáo</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="religion" name="religion" placeholder="Tôn giáo" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="nation">Dân tộc</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="nation" name="nation" placeholder="Dân tộc" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Trạng thái</label>
                                                <div class="col-sm-8">
                                                    <select name="status" id="" class="form-control">
                                                        <option value="Đang làm việc">Đang làm việc</option>
                                                        <option value="Nghỉ việc">Nghỉ việc</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                        <div class="row">
                                            <div class="col-sm-5 offset-sm-5">
                                                <button type="submit" class="btn btn-primary" name="submit" value="Sign up">Thêm nhân viên</button>
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
</body>

</html>