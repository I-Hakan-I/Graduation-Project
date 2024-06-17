<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['item_id'])) {
    $id = $conn->real_escape_string($_POST['item_id']);
    $sql = "DELETE FROM basket WHERE id = '$id' LIMIT 1";

    if ($conn->query($sql) === TRUE) {
        header("Location: shopping_cart.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request method.";
}
?>
