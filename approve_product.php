<?php
include 'config.php';

$tableName = $_POST['table'];
$productName = $_POST['product'];

$sql = "UPDATE $tableName SET approved = TRUE WHERE name = '$productName'";
if (mysqli_query($conn, $sql)) {
    $checkSql = "SELECT COUNT(*) as count FROM $tableName WHERE approved = FALSE";
    $checkResult = mysqli_query($conn, $checkSql);
    $countRow = mysqli_fetch_assoc($checkResult);

    if ($countRow['count'] == 0) {
        $dropTableSql = "DELETE FROM $tableName";
        if (mysqli_query($conn, $dropTableSql)) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "success";
    }
} else {
    echo "error";
}

mysqli_close($conn);
?>
