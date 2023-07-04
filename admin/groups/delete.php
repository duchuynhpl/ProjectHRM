<?php
require('../../login/connect.php');
?>

<?php
if (isset($_GET['idcv'])) {
    $idcv = $_GET['idcv'];
}
?>
<?php
    $sql = "DELETE FROM work WHERE idcv= $idcv";
    $query = mysqli_query($con, $sql);
    header('Location: /admin/groups/');
?>