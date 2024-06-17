<?php
include "config.php";

$table_no = $_POST['table_no'];
$cart_items_json = $_POST['cart_items'];

$cart_items = json_decode($cart_items_json, true);

$table_name = strtolower($table_no);

$insert_values = '';
foreach ($cart_items as $item) {
    $name = $item['name'];
    $price = $item['price'];
    $quantity = $item['quantity'];
    $insert_values .= "('$name', $price, $quantity),";
}
$insert_values = rtrim($insert_values, ',');

$sql = "INSERT INTO $table_name (name, price, quantity) VALUES $insert_values";
if ($conn->query($sql) === TRUE) {
    echo "The order has been successfully added to the database.";
    $sql_delete = "DELETE FROM basket WHERE name IN (SELECT name FROM $table_name)";
    if ($conn->query($sql_delete) === TRUE) {
        echo "The data in the basket table has been deleted successfully.";
    } else {
        echo "Error deleting data in basket table: " . $conn->error;
    }
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: order_complate.php");
    exit();
?>
