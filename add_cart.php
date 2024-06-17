<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $price = $conn->real_escape_string($_POST['price']);
    $id = $conn->real_escape_string($_POST['id']);
    
    error_log("Received POST data: Name = $name, Price = $price, Id = $id");
    $sql = "INSERT INTO basket (name, price, id) VALUES ('$name', '$price', '$id')";
    
    error_log("Executing SQL query: $sql");

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        error_log("New record created successfully");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        error_log("SQL error: " . $conn->error);
    }
} else {
    echo "Invalid request method.";
    error_log("Invalid request method.");
}

$conn->close();
?>
