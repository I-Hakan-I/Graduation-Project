<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_id = intval($_POST['item_id']);
    $action = $_POST['action'];

    if ($action == "increase") {
        $sql = "INSERT INTO basket (id, name, price) SELECT id, name, price FROM basket WHERE id = ? LIMIT 1";
    } elseif ($action == "decrease") {
        $sql = "DELETE FROM basket WHERE id = ? LIMIT 1";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $item_id);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    header("Location: shopping_cart.php");
    exit();
}
?>
