<?php
require_once('../../database/dbhelper.php');
?>

<?php
require('../../login/connect.php');

$user = $_SESSION['users'];

?>

<?php
    if (isset($_GET['masp'])) {
       $masp = $_GET['masp'];
    }
?>

<?php
    $sql = "SELECT * FROM product WHERE masp= $masp";
    $query = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($query);
?>

<?php
if(isset($_POST['submit'])){
    $tensp = $_POST['nameproduct'];
    $price = $_POST['price'];
    $num = $_POST['num'];
    $maloai = $_POST['maloai'];
    $uploadfile = basename($_FILES["file_upload"]["name"]);

   
        $sql = "UPDATE product SET tensp ='$tensp', pice ='$price', soluong ='$num',img ='$uploadfile',maloai ='$maloai' WHERE masp= $masp ";
        $query = mysqli_query($con, $sql);
        if($query){
            echo '<script language="javascript">
                alert("Đã thay đổi thành công"); 
                window.location = "/admin/product";
                 </script>';
        }

    //upload file
    $target_dir = "uploads/";
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
    <link rel="stylesheet" href="../css/sidebar.css">

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
                    <input type="text" placeholder="Search...">
                </a>
                <!-- <span class="tooltip">Quản trị viên</span> -->
            </li>
            <li>
                <a href="/admin/user.php">
                    <i class='bx bxs-user'></i>
                    <span class="links_name">nhân viên</span>
                </a>
                <span class="tooltip">nhân viên</span>
            </li>
            <li>
                <a href="/admin/table/index.php">
                    <i class='bx bx-notepad'></i>
                    <span class="links_name">Bàn</span>
                </a>
                <span class="tooltip">Bàn</span>
            </li>
            <li>
                <a href="/admin/groups">
                    <i class='bx bxs-group'></i>
                    <span class="links_name">Nhóm chức vụ</span>
                </a>
                <span class="tooltip">Nhóm chức vụ</span>
            </li>
            <li>
                <a href="/admin/product/index.php" class="active">
                    <i class='bx bx-notepad'></i>
                    <span class="links_name">Món ăn</span>
                </a>
                <span class="tooltip">Món ăn</span>
            </li>
            <li>
                <a href="/admin/order">
                    <i class='bx bx-basket'></i>
                    <span class="links_name">Đơn hàng</span>
                </a>
                <span class="tooltip">Đơn hàng</span>
            </li>
            <li>
                <a href="/admin/dashboard.php">
                    <i class='bx bx-pie-chart-alt'></i>
                    <span class="links_name">Thống kê doanh thu</span>
                </a>
                <span class="tooltip">Thống kê doanh thu</span>
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
                                <h3 class="text-center">Thay đổi thông tin sản phẩm</h3>
                            </div>
                            <div class="card-body">   
                                <form method='POST' action="" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Tên sản phẩm</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="nameproduct" value="<?php echo $data['tensp']; ?>" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Giá</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="price" value="<?php echo $data['pice']; ?>" />
                                        </div>
                                    </div> 

                                    <div class="form-group row">
                                    <label class="col-sm-5 col-form-label" for="work">Loại sản phẩm</label>
                                    <div class="col-sm-7">
                                        <select name="maloai" id="" class="form-control">
                                            <?php
                                            $sql = mysqli_query($con, "SELECT * FROM producttype");
                                            $productList = mysqli_fetch_all($sql, MYSQLI_ASSOC);
                                            foreach($productList as $product)
                                             echo '
                                            <option value="'.$product['maloai'].'">'.$product['loaisp'].'</option>
                                            ';
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Số lượng</label>
                                        <div class="col-sm-7">
                                            <input type="number" class="form-control" name="num" value="<?php echo $data['soluong']; ?>" />
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Thêm ảnh sản phẩm</label>
                                        <div class="col-sm-7">
                                            <input type="file" name="file_upload"/>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-5 offset-sm-4">
                                            <button type="submit" class="btn btn-primary" name="submit" value="Sign up">Thay đổi</button>
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