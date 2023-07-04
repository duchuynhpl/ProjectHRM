<?php
require('../login/connect.php');
?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
?>
<?php
    $sql = "DELETE FROM user WHERE id= $id";
    $query = mysqli_query($con, $sql);
    header('Location: ../admin/user.php');
?>