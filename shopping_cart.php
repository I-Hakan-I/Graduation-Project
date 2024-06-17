<?php
include "config.php";

$sql = "SELECT id, name, price, COUNT(*) as quantity FROM basket GROUP BY name";
$result = $conn->query($sql);

$basket_items = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $basket_items[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Axse-Shopping Cart</title>
    <link rel="stylesheet" href="./css/basket.css">
</head>
<body>
<div class="container">
    <div class="mainBox">
        <h1>Shopping Cart</h1>
        <?php if (count($basket_items) > 0): ?>
            <?php 
                $total_price = 0;
                foreach ($basket_items as $item) {
                    $total_price += $item['price'] * $item['quantity'];
                }
            ?>
            <ul class="cart-items">
                <?php foreach ($basket_items as $item): ?>
                    <li type="none">
                        <span><?php echo $item["name"]; ?> - <?php echo $item["price"]; ?> TL - </span>
                        <form action="update_cart.php" method="post" style="display:inline;">
                            <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                            <input type="hidden" name="action" value="decrease">
                            <button type="submit" onclick="refreshPage()"><ion-icon name="remove-outline"></ion-icon></button>
                        </form>
                        <span> Amount: <?php echo $item["quantity"]; ?> </span>
                        <form action="update_cart.php" method="post" style="display:inline;">
                            <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                            <input type="hidden" name="action" value="increase">
                            <button type="submit" onclick="refreshPage()"><ion-icon name="add-outline"></ion-icon></button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
<form id="checkoutForm" action="update_table.php" method="post">
    <p style="font-weight: bold">Please select your table: </p>
    <select id="table_no" name="table_no">
        <option value="paris">Paris</option>
        <option value="london">Londra</option>
        <option value="tokyo">Tokyo</option>
        <option value="istanbul">İstanbul</option>
        <option value="barcelona">Barcelona</option>
        <option value="milano">Milano</option>
        <option value="cologne">Cologne</option>
    </select>
    <p style="font-weight: bold">Total Price: <?php echo $total_price; ?> TL</p>
    <input type="hidden" id="cart_items" name="cart_items" value="<?php echo htmlspecialchars(json_encode($basket_items)); ?>">
</form>
        <?php else: ?>
            <p style="font-weight: bold">Your cart is empty.</p>
            <script>
                closeCardInfo();
            </script>
        <?php endif; ?>
    </div>
</div>
<div class="cardInfo">
    <form class="credit-card">
        <div class="form-header">
            <h1 class="title">AXSE</h1>
            <h4 class="">Credit card detail</h4>
        </div>
        
        <div class="form-body">
            <input type="text" class="card-number" placeholder="Card Number">
            <div class="date-field">
                <div class="month">
                    <select name="Month">
                        <option value="january">January</option>
                        <option value="february">February</option>
                        <option value="march">March</option>
                        <option value="april">April</option>
                        <option value="may">May</option>
                        <option value="june">June</option>
                        <option value="july">July</option>
                        <option value="august">August</option>
                        <option value="september">September</option>
                        <option value="october">October</option>
                        <option value="november">November</option>
                        <option value="december">December</option>
                    </select>
                </div>
                <div class="year">
                    <select name="Year">
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                        <option value="2031">2031</option>
                        <option value="2032">2032</option>
                        <option value="2033">2033</option>
                        <option value="2034">2034</option>
                        <option value="2035">2035</option>
                        <option value="2036">2036</option>
                    </select>
                </div>
            </div>
            <div class="card-verification">
                <div class="cvv-input">
                    <input type="number" placeholder="CVV" minlength="3" maxlength="4">
                </div>
                <div class="cvv-details">
                    <p>&nbsp<br>&nbsp</p>
                </div>
            </div>
            <input type="hidden" id="cart_items" name="cart_items" value="<?php echo htmlspecialchars(json_encode($basket_items)); ?>">
            <button type="submit" class="checkout-btn">Checkout</button>
        </div>
    </form>
</div>
<script>
function refreshPage() {
    location.reload();
}

function closeCardInfo() {
    document.querySelector('.cardInfo').style.display = 'none';
}
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('.checkout-btn').addEventListener('click', function (event) {
            event.preventDefault();
            document.getElementById('checkoutForm').submit();
        });
    });
</script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
