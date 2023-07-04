<?php
require('../../login/connect.php');
?>


<?php
if (isset($_GET['id_reward'])) {
    $id = $_GET['id_reward'];
}
?>
<?php
    $sql = "DELETE FROM reward WHERE id_reward= $id";
    $query = mysqli_query($con, $sql);
    header('Location: ../reward/reward.php');
?>