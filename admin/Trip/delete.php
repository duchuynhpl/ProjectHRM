<?php
require('../../login/connect.php');
?>


<?php
if (isset($_GET['id_business'])) {
    $id = $_GET['id_business'];
}
?>
<?php
    $sql = "DELETE FROM business WHERE id_business= $id";
    $query = mysqli_query($con, $sql);
    header('Location: ../trip');
?>