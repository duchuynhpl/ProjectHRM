<?php
require_once('../database/dbhelper.php');

?>

<?php
require('../database/connect.php');

$user = $_SESSION['users'];

?>

<!-- Tìm kiếm sản phẩm 
SELECT * from product,producttype where product.maloai=producttype.loaisp like '%Nước uống%' -->

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
        <div class="text" style="font-weight: bold;">Danh sách nhân viên đi công tác</div>

        <div class="center">
            <div class="container">
                <div class="row">
                    <a href="add.php">
                        <button class="btn btn-success" style="margin-bottom:20px">Thêm lịch công tác</button>
                    </a>
                    <table class="table table-striped">
                        <thead class="blue">
                            <tr>
                                <th>Mã CB</th>
                                <th>Họ và tên</th>
                                <th>Nội dung công tác</th>
                                <th>Nơi đi</th>
                                <th>Ngày đi</th>
                                <th>Ngày về</th>
                                <th>Trạng thái</th>
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
                                
                                // Lấy danh sách product
                                $sql = "SELECT * FROM business,user WHERE business.id_user=user.id ORDER BY id_business ASC limit $start,$limit";
                                $tripList = executeResult($sql);
                                $stt = 1;
                                foreach ($tripList as $trip) {
                                    echo ' <tr>
                                <th>'.$trip['employee_id'].'</th>
                                <th>'.$trip['hoten'].'</th>
                                <th>'.$trip['content'].'</th>
                                <th>'.$trip['addressbn'].'</th>
                                <th>'.$trip['departuredate'].'</th>
                                <th>'.$trip['returndate'].'</th>
                                <th>'.$trip['statustrip'].'</th>
                                <th>
                                    <a href="delete.php?id_business=' . $trip['id_business'] . '">
                                        <button class="btn btn-danger">Xoá</button>
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
                    $sql = 'SELECT * FROM business';
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
            </div>
        </div>
    </div>
</body>

</html>