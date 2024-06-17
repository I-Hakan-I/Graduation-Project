<?php
include 'config.php';

$sql_basket = "SELECT COUNT(*) as item_count FROM basket";
$result_basket = $conn->query($sql_basket);
$item_count = 0;
if ($result_basket->num_rows > 0) {
    $row = $result_basket->fetch_assoc();
    $item_count = $row['item_count'];
}

echo $item_count;
?>
