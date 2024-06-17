<?php
include 'config.php';

$tableName = $_GET['table'];
$sql = "SELECT COUNT(*) as count FROM $tableName WHERE approved = FALSE";
$result = mysqli_query($conn, $sql);
$countRow = mysqli_fetch_assoc($result);

if ($countRow['count'] == 0) {
    echo "empty";
} else {
    echo "not empty";
}

mysqli_close($conn);
?>
