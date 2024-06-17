<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/admin.css">
    <title>Admin Paneli</title>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <h1>Admin Panel</h1>
    <div id="tables-container">
        <?php
        include 'config.php';
        function generateTableLinks($conn) {
            $sql = "SHOW TABLES FROM menu";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                while ($row = mysqli_fetch_row($result)) {
                    $tableName = $row[0];
                    if (!in_array($tableName, ['foods', 'coffees', 'desserts', 'basket', 'users'])) {
                        $checkUnapprovedSql = "SELECT COUNT(*) as count FROM $tableName WHERE approved = FALSE";
                        $checkResult = mysqli_query($conn, $checkUnapprovedSql);
                        $icon = "";
                        if ($checkResult) {
                            $countRow = mysqli_fetch_assoc($checkResult);
                            if ($countRow['count'] > 0) {
                                $icon = "<ion-icon name='fast-food-outline'></ion-icon>";
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
    </div>

    <div id="popup" class="popup">
        <span class="close">&times;</span>
        <div id="popup-content"></div>
    </div>

    <script>
        function loadTableLinks() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('tables-container').innerHTML = xhr.responseText;
                    attachLinkEventHandlers();
                }
            };
            xhr.open("GET", "load_table_links.php", true);
            xhr.send();
        }

        function attachLinkEventHandlers() {
            var tableLinks = document.querySelectorAll('.table-link');
            tableLinks.forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    var tableName = this.getAttribute('data-table');
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            var popupContent = document.getElementById('popup-content');
                            popupContent.innerHTML = xhr.responseText;
                            var popup = document.getElementById('popup');
                            popup.style.display = 'block';
                            attachApproveEventHandlers(tableName);
                        }
                    };
                    xhr.open("GET", "get_table_content.php?table=" + tableName, true);
                    xhr.send();
                });
            });
        }

        function attachApproveEventHandlers(tableName) {
            var approveBtns = document.querySelectorAll('.approve-btn');
            approveBtns.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var productName = this.getAttribute('data-product');
                    var confirmation = confirm("Did you want to approve it?");
                    if (confirmation) {
                        var approveXhr = new XMLHttpRequest();
                        approveXhr.onreadystatechange = function() {
                            if (approveXhr.readyState == 4 && approveXhr.status == 200) {
                                if (approveXhr.responseText == "success") {
                                    btn.style.display = 'none';
                                    var checkmark = document.createElement('ion-icon');
                                    checkmark.setAttribute('name', 'checkmark-outline');
                                    btn.parentElement.appendChild(checkmark);
                                    console.log(productName + " item is aproved!");
                                    checkIfTableIsEmpty(tableName);
                                } else {
                                    console.log(productName + " An error occurred while approving the product.");
                                }
                            }
                        };
                        approveXhr.open("POST", "approve_product.php", true);
                        approveXhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        approveXhr.send("table=" + tableName + "&product=" + productName);
                    }
                });
            });
        }

        function checkIfTableIsEmpty(tableName) {
            var checkXhr = new XMLHttpRequest();
            checkXhr.onreadystatechange = function() {
                if (checkXhr.readyState == 4 && checkXhr.status == 200) {
                    if (checkXhr.responseText == "empty") {
                        document.querySelector("[data-table='" + tableName + "']").remove();
                    }
                }
            };
            checkXhr.open("GET", "check_table_status.php?table=" + tableName, true);
            checkXhr.send();
        }

        var closeBtn = document.getElementsByClassName('close')[0];
        closeBtn.addEventListener('click', function() {
            var popup = document.getElementById('popup');
            popup.style.display = 'none';
        });
        loadTableLinks();
        setInterval(loadTableLinks, 5000);
    </script>
</body>
</html>
