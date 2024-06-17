<?php
include 'config.php';

function generateTableLinks($conn) {
    $sql = "SHOW TABLES FROM menu";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_row($result)) {
            $tableName = $row[0];
            if (!in_array($tableName, ['foods', 'coffees', 'desserts', 'basket', 'users'])) {
                $icon = "";
                $checkColumnSql = "SHOW COLUMNS FROM $tableName LIKE 'approved'";
                $columnResult = mysqli_query($conn, $checkColumnSql);
                if ($columnResult && mysqli_num_rows($columnResult) > 0) {
                    $checkUnapprovedSql = "SELECT COUNT(*) as count FROM $tableName WHERE approved = FALSE";
                    $checkResult = mysqli_query($conn, $checkUnapprovedSql);
                    if ($checkResult) {
                        $countRow = mysqli_fetch_assoc($checkResult);
                        if ($countRow['count'] > 0) {
                            $icon = "<ion-icon name='fast-food-outline'></ion-icon>";
                        }
                    }
                }
                echo "<div class='table-container' data-table='$tableName'>";
                echo "<ul>";
                echo "<li><a href='#' class='table-link' data-table='$tableName'><h2>$tableName $icon</h2></a></li>";
                echo "</ul>";
                echo "</div>";
            }
        }
    } else {
        echo "<p>Tablo bulunamadı</p>";
    }
}

generateTableLinks($conn);
mysqli_close($conn);
?>
