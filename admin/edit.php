<?php
require_once('../database/dbhelper.php');
?>

<?php
require('../login/connect.php');

$user = $_SESSION['users'];

?>

<?php
    if (isset($_GET['id'])) {
       $id = $_GET['id'];
    }
?>

<?php
    $sql = "SELECT * FROM user,work WHERE user.idcv=work.idcv and id= $id";
    $query = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($query);
?>

<?php
if(isset($_POST['submit'])){
    $name = htmlspecialchars($_POST['fullname']);
    $work = htmlspecialchars($_POST['workcv']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $speciality = htmlspecialchars($_POST['speciality']);
    $cccd = htmlspecialchars($_POST['cccd']);
    $datecccd = htmlspecialchars($_POST['datecccd']);
    $sex = htmlspecialchars($_POST['sex']);
    $birthday = htmlspecialchars($_POST['birthday']);
    $placebirth = htmlspecialchars($_POST['placebirth']);
    $degree = htmlspecialchars($_POST['degree']);
    $level = htmlspecialchars($_POST['level']);
    $national = htmlspecialchars($_POST['national']);
    $religion = htmlspecialchars($_POST['religion']);
    $nation = htmlspecialchars($_POST['nation']);
    $avatar = htmlspecialchars($_POST['avatar']);
    $status = htmlspecialchars($_POST['status']);
    $typeemployee = htmlspecialchars($_POST['typeemployee']);
    $uploadfile = basename($_FILES["file_upload"]["name"]);
    $faculty_id = htmlspecialchars($_POST['faculty_id']);

   
        $sql = "UPDATE user SET hoten ='$name',phone ='$phone',email ='$email',address ='$address',idcv ='$work',
        speciality ='$speciality', cccd = '$cccd', datecccd='$datecccd', sex ='$sex', birthday= '$birthday', placebirth='$placebirth', degree='$degree', level='$level', national='$national', religion='$religion', nation='$nation', status='$status', typeemployee='$typeemployee', avatar='$uploadfile', id_faculty='$faculty_id'  WHERE id= $id ";
        $query = mysqli_query($con, $sql);
        if($query){
            echo '<script language="javascript">
                alert("Đã thay đổi thành công"); 
                window.location = "../admin/user.php";
                 </script>';
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
                                <h3 class="text-center">Thay đổi thông tin</h3>
                            </div>
                            <div class="card-body">   
                                <form method='POST' action="" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-6">

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Mã CB</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="fullname" value="<?php echo $data['employee_id']; ?>" readonly/>
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
                                                <input type="text" class="form-control" name="fullname" value="<?php echo $data['hoten']; ?>" />
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
                                            <label class="col-sm-4 col-form-label">Email</label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control" name="email" value="<?php echo $data['email']; ?>" />
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">SĐT</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="phone" value="<?php echo $data['phone']; ?>" />
                                            </div>
                                        </div> 

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label">Địa chỉ</label>
                                            <div class="col-sm-8">
                                                <textarea name="address" cols="35" rows="4"><?php echo $data['address']; ?></textarea>
                                            </div>
                                        </div> 

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="speciality">Chuyên môn</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="speciality" name="speciality" value="<?php echo $data['speciality']; ?>" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                                <label class="col-sm-4 col-form-label" for="typeemployee">Loại nhân viên</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="typeemployee" name="typeemployee" value="<?php echo $data['typeemployee']; ?>" />
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
                                            <label class="col-sm-4 col-form-label" for="cccd">Số CCCD</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="cccd" name="cccd" value="<?php echo $data['cccd']; ?>" />
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="datecccd">Ngày cấp CCCD</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" id="datecccd" name="datecccd" value="<?php echo $data['datecccd']; ?>" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                        <label class="col-sm-4 col-form-label" for="work">Giới tính</label>
                                            <div class="col-sm-8">
                                                <select name="sex" id="" class="form-control">
                                                    <?php
                                                    echo '
                                                    <option value="Nam">Nam</option>
                                                    <option value="Nữ">Nữ</option>
                                                    ';
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="birthday">Ngày sinh</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo $data['birthday']; ?>" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="placebirth">Nơi sinh</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="placebirth" name="placebirth" value="<?php echo $data['placebirth']; ?>" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="degree">Bằng cấp</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="degree" name="degree" value="<?php echo $data['degree']; ?>" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="level">Trính độ</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="level" name="level" value="<?php echo $data['level']; ?>" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="national">Quốc tịch</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="national" name="national" value="<?php echo $data['national']; ?>" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="religion">Tôn giáo</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="religion" name="religion" value="<?php echo $data['religion']; ?>" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="nation">Dân tộc</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="nation" name="nation" value="<?php echo $data['nation']; ?>" />
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
                                    <div class="col-sm-4 offset-sm-5">
                                        <button type="submit" class="btn btn-primary" name="submit" value="Sign up">Thay đổi</button>
                                    </div>
                                </div>

                                    <?php $id = $data['id']; ?>
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

