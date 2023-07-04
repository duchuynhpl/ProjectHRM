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
    $sql = "SELECT * FROM user,work,faculty WHERE user.id_faculty=faculty.idfaculty AND id= $id";
    $query = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CT466-12</title>
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/profile.css">

    <!--Box Icon CSS-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"/>	
</head>
<body>
<?php require "layout/sidebar.php"; ?>

<div class="home_content">
            <div class="center">
            <div class="container">
    <div class="main-body">
    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="user.php">Trang chủ</a></li>
              <li class="breadcrumb-item active">Thông tin cá nhân</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
          <div class="row gutters-sm">
            <div class="col-md-3 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="upload/<?php echo $data['avatar']?>" alt="Avatar" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?php echo $data['hoten']; ?></h4>
                      <p class="text-secondary mb-1"><?php echo $data['employee_id']; ?></p>
                      <p class="text-secondary mb-1"><?php echo $data['tencv']; ?></p>
                      <button class="btn btn-danger">Báo cáo lỗi</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="cardz mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0" style="color:red;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Thông báo</h6><br>
                    <span class="text-secondary"><marquee class="notices">Trung tâm viễn thông Bạc Liêu 4 - Viễn thông Bạc Liêu</marquee></span>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-9">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-2">
                      <h6 class="mb-0">Họ và tên:</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                    <?php echo $data['hoten']; ?>
                    </div>
                    <div class="col-sm-2 ml-5">
                      <h6 class="mb-0">Chức vụ:</h6>
                    </div>
                    <div class="col-sm-3">
                    <h6 style="font-weight: bold; font-size: 16px"><?php echo $data['tencv']; ?></h6>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-2">
                      <h6 class="mb-0">Giới tính:</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                        <?php if(empty($data['sex'])){
                          echo 'Chưa cập nhật thông tin';
                        } else {
                          echo ''.$data['sex'].'';
                        } ?>
                    </div>
                    <div class="col-sm-2 ml-5">
                      <h6 class="mb-0">Bằng cấp:</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                    <?php echo $data['degree'] ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-2">
                      <h6 class="mb-0">Ngày sinh:</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                      <?php echo $data['birthday'] ?>
                    </div>
                    <div class="col-sm-2 ml-5">
                      <h6 class="mb-0">Nơi sinh:</h6>
                    </div>
                    <div class="col-sm-4 text-secondary">
                    <?php echo $data['placebirth'] ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-2">
                      <h6 class="mb-0">Số CCCD:</h6>
                    </div>
                    <div class="col-sm-3">
                    <h6 style="font-weight: bold; font-size: 16px"><?php echo $data['cccd']; ?></h6>
                    </div>
                    <div class="col-sm-2 ml-5">
                      <h6 class="mb-0">Ngày cấp:</h6>
                    </div>
                    <div class="col-sm-4 text-secondary">
                    <?php echo $data['datecccd'] ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-2">
                      <h6 class="mb-0">Trình độ:</h6>
                    </div>
                    <div class="col-sm-3">
                    <h6 style="font-weight: bold; font-size: 16px"><?php echo $data['level']; ?></h6>
                    </div>
                    <div class="col-sm-2 ml-5">
                      <h6 class="mb-0">Chuyên môn:</h6>
                    </div>
                    <div class="col-sm-4">
                    <h6 style="font-weight: bold; font-size: 16px"><?php echo $data['speciality']; ?></h6>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-2">
                      <h6 class="mb-0">Phòng ban:</h6>
                    </div>
                    <div class="col-sm-3">
                    <h6 style="font-weight: bold; font-size: 16px"><?php echo $data['namefaculty']; ?></h6>
                    </div>
                    <div class="col-sm-2 ml-5">
                      <h6 class="mb-0">Loại nhân viên:</h6>
                    </div>
                    <div class="col-sm-4">
                    <h6 style="font-weight: bold; font-size: 16px"><?php echo $data['typeemployee']; ?></h6>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-2">
                      <h6 class="mb-0">Quốc tịch:</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                    <?php echo $data['national'] ?>
                    </div>
                    <div class="col-sm-2 ml-5">
                      <h6 class="mb-0">Dân tộc:</h6>
                    </div>
                    <div class="col-sm-4 text-secondary">
                    <?php echo $data['nation'] ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-2">
                      <h6 class="mb-0">Tôn giáo:</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                    <?php echo $data['religion'] ?>
                    </div>
                    <div class="col-sm-2 ml-5">
                      <h6 class="mb-0">Tạm trú:</h6>
                    </div>
                    <div class="col-sm-4 text-secondary">
                    <?php echo $data['address'] ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-2">
                      <h6 class="mb-0">Trạng thái:</h6>
                    </div>
                    <div class="col-sm-3">
                      <h6 style="font-weight: bold; font-size: 16px; color: #00a70d;"><?php echo $data['status']; ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row gutters-sm">
              <div class="col-md-12 mb-3">
                <div class="card">
                  <div class="card-body">
                    <h5>Bảng lương nhân viên</h5> 
                    <table class="table table-striped">
                      <thead class="blue" style="color: #fff">
                        <tr>
                            <th>STT</th>
                            <th>Mã Lương</th>
                            <th>Mã CB</th>
                            <th>Lương ngày</th>
                            <th>Ngày công</th>
                            <th>Lương tháng</th>
                            <th>Phụ cấp</th>
                            <th>Tạm ứng</th>
                            <th>Thực lãnh</th>
                            <th>Ngày chấm</th>
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
                                
                                // Lấy danh sách product
                                $sql = "SELECT * FROM user,salary where user.id=salary.id_user AND id='$id' ORDER BY idsalary ASC limit $start,$limit";
                                $salaryList = executeResult($sql);
                                $stt = 1;
                                foreach ($salaryList as $salary) {
                                    echo ' <tr>
                                    <th> '.$salary['id'].'</th>
                                    <th> 456</th>
                                    <th> '.$salary['employee_id'].'</th>
                                    <td class="price-red">' . number_format($salary['payday'], 0, ',', '.') . '<span> VNĐ</span></td>
                                    <th> '.$salary['workday'].'</th>
                                    <th> ' . number_format($salary['monthsalary'], 0, ',', '.') . '<span> VNĐ</span></th>
                                    <th> ' . number_format($salary['allowance'], 0, ',', '.') . '<span> VNĐ</span></th>
                                    <th> ' . number_format($salary['salaryadvance'], 0, ',', '.') . '<span> VNĐ</span></th>
                                    <th> ' . number_format($salary['realsalary'], 0, ',', '.') . '<span> VNĐ</span></th>
                                    <th> ' . $salary['timepayday'].'</th>
                                    </tr>';
                                }
                            } catch (Exception $e) {
                                die("Lỗi thực thi sql: " . $e->getMessage());
                            } 
                                ?>
                      </tbody>
                    </table>
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