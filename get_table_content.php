<?php
include 'config.php';

if(isset($_GET['table'])) {
    $tableName = $_GET['table'];
    
    $sql = "SELECT * FROM $tableName";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<h2>Sipariş İçeriği: $tableName</h2>";
        echo "<form id='order-form'>";
        echo "<ul>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<li>";
            echo "<strong>Ürün Adı:</strong> " . $row['name'] . " - <strong>Miktar:</strong> " . $row['quantity'];
            if ($row['approved']) {
                echo "<ion-icon name='checkmark-outline'></ion-icon>";
            } else {
                echo "<button type='button' class='approve-btn' data-product='" . $row['name'] . "'>Onayla</button>";
            }
            echo "</li>";
        }
        echo "</ul>";
        echo "</form>";
    } else {
        echo "<p>Tablo içeriği bulunamadı</p>";
    }
} else {
    echo "<p>Geçersiz istek</p>";
}

mysqli_close($conn);
?>
