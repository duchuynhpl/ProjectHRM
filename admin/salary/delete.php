<?php
require('../../login/connect.php');
?>


<?php
if (isset($_GET['idsalary'])) {
    $id = $_GET['idsalary'];
}
?>
<?php
    $sql = "DELETE FROM salary WHERE idsalary= $id";
    $query = mysqli_query($con, $sql);
    header('Location: ../salary');
?>