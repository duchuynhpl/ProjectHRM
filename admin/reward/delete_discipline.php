<?php
require('../../login/connect.php');
?>


<?php
if (isset($_GET['id_discipline'])) {
    $id = $_GET['id_discipline'];
}
?>
<?php
    $sql = "DELETE FROM discipline WHERE id_discipline= $id";
    $query = mysqli_query($con, $sql);
    header('Location: ../reward/discipline.php');
?>