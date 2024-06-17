<!--oncontextmenu="return false;" Body'nin içerisine yazılacak-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Axse-Menu</title>
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<?php
include 'config.php';

$sql_foods = "SELECT id, name, price FROM foods";
$result_foods = $conn->query($sql_foods);
$foods = array();
if ($result_foods->num_rows > 0) {
    while($row = $result_foods->fetch_assoc()) {
        $foods[] = $row;
    }
}

$sql_coffees = "SELECT id, name, price FROM coffees";
$result_coffees = $conn->query($sql_coffees);
$coffees = array();
if ($result_coffees->num_rows > 0) {
    while($row = $result_coffees->fetch_assoc()) {
        $coffees[] = $row;
    }
}

$sql_desserts = "SELECT id, name, price FROM desserts";
$result_desserts = $conn->query($sql_desserts);
$desserts = array();
if ($result_desserts->num_rows > 0) {
    while($row = $result_desserts->fetch_assoc()) {
        $desserts[] = $row;
    }
}
?>
<body style="background-color: #141414;" oncontextmenu="return false;">
<div class="cart-icon">
        <a href="shopping_cart.php"><ion-icon name="cart-outline"></ion-icon></a>
        <span class="item-count">
        <?php include 'get_itemCount.php'; ?></span>
    </div>
    <div class="Boxbtn">
        <a><span class="mainBtn" onclick="toggleNav()"><ion-icon id="iconBtn" name="caret-forward-outline"></ion-icon></span></a>
    </div>
    <div id="mySidenav" class="sidenav">
        <a href="./mainSite.php">All Things</a>
        <a href="./index.php">Main Page</a>
        <a href="./menu.php">Menu</a>
        <a href="./404.php">About Me</a>
    </div>
        <div class="banner">
            <div class="logo">
                <a href="">
                <h3>Axse</h3>
                <p>&nbsp;</p>
                </a>
            </div>
        </div>
        <div class="content contentimg">
            <div class="menus" id="menuContainer">
                <div class="list">
                    <div class="item" id="menu-a1">
                        <div>FOODS</div>
                        <img src="img/3.png">
                        <div><br><br>MENU<br><ion-icon name="arrow-down-outline"></ion-icon></div>
                    </div>
                    <div class="item active" id="menu-a2">
                        <div>DRINKS</div>
                        <img src="img/2.png">
                        <div><br><br>MENU<br><ion-icon name="arrow-down-outline"></ion-icon></div>
                    </div>
                    <div class="item" id="menu-a3">
                        <div>DESSERTS</div>
                        <img src="img/1.png">
                        <div><br><br>MENU<br><ion-icon name="arrow-down-outline"></ion-icon></div>
                    </div>
                </div>
                <div class="arow">
                    <button class="prev" id="prev">&lt;</button>
                    <button class="next" id="next">&gt;</button>
                </div>
            </div>
            <div class="vertical-menu">
                <div class="menu-content hidden" id="menu-a1">
                    <div class="item-slider" id="m1">
                        <?php foreach ($foods as $item): ?>
                            <div class="items">
                                <img src="./img/<?php echo strtolower(str_replace(' ', '-', $item['name'])); ?>.png">
                                <br><br><div class="item-name"><?php echo $item['name']; ?></div><br>
                                <div class="information">Our Varieties</div><br>
                                <div class="itemPrice"><?php echo $item['price']; ?> TL</div>
                                <button onclick="addToCart('<?php echo $item['name']; ?>', '<?php echo $item['price']; ?>', '<?php echo $item['id']; ?>')" class="payBtn" method="POST"><ion-icon name="cart-outline"></ion-icon> Add Cart</button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="menu-content" id="menu-a2">
                    <div class="item-slider" id="m2">
                        <?php foreach ($coffees as $item): ?>
                            <div class="items">
                                <img src="./img/<?php echo strtolower(str_replace(' ', '-', $item['name'])); ?>.png">
                                <br><br><div class="item-name"><?php echo $item['name']; ?></div><br>
                                <div class="information">Our Varieties</div><br>
                                <div class="itemPrice"><?php echo $item['price']; ?> TL</div>
                                <button onclick="addToCart('<?php echo $item['name']; ?>', '<?php echo $item['price']; ?>', '<?php echo $item['id']; ?>')" class="payBtn" method="POST"><ion-icon name="cart-outline"></ion-icon> Add Cart</button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="menu-content hidden" id="menu-a3">
                    <div class="item-slider" id="m3">
                        <?php foreach ($desserts as $item): ?>
                            <div class="items">
                                <img src="./img/<?php echo strtolower(str_replace(' ', '-', $item['name'])); ?>.png">
                                <br><br><div class="item-name"><?php echo $item['name']; ?></div><br>
                                <div class="information"></div><br>
                                <div class="itemPrice"><?php echo $item['price']; ?> TL</div>
                                <button onclick="addToCart('<?php echo $item['name']; ?>', '<?php echo $item['price']; ?>', '<?php echo $item['id']; ?>')" class="payBtn" method="POST"><ion-icon name="cart-outline"></ion-icon> Add Cart</button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>                
            </div>
            <footer>
                <div class="footer">
                    
                </div>
            </footer>
        </div>  
    
    <script class="sidebarjs">
        function toggleNav() {
    var mainBtn = document.querySelector('.Boxbtn');
    mainBtn.classList.toggle('active');

    if (mainBtn.classList.contains('active')) {
        openNav();
        rotateIcon(true);
    } else {
        closeNav();
        rotateIcon(false);
    }
}

function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("prev").style.left = "270px";
    document.getElementById("prev").style.transition = "left 0.36s ease-in-out";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("prev").style.left = "50px";
    document.getElementById("prev").style.transition = "left 0.45s ease-in-out";
}

function rotateIcon(active) {
    var icon = document.getElementById('iconBtn');
    if (active) {
        icon.style.transform = "rotate(180deg)";
        icon.style.transition = "0.5s";
    } else {
        icon.style.transform = "rotate(360deg)";
        icon.style.transition = "0.5s";
    }
}

    </script>
    <script>
let circle = document.querySelector('.circle');
let slider = document.querySelector('.slider');
let list = document.querySelector('.list');
let prev = document.getElementById('prev');
let next = document.getElementById('next');
let items = document.querySelectorAll('.list .item');
let count = items.length;
let active = 1;
let leftTransform = 0;
let width_item = items[active].offsetWidth;

next.onclick = () => {
    active = active >= count - 1 ? count - 1 : active + 1;
    runCarousel();
}
prev.onclick = () => {
    active = active <= 0 ? active : active - 1;
    runCarousel();
}
function runCarousel() {
    prev.style.display = (active == 0) ? 'none' : 'block';
    next.style.display = (active == count - 1) ? 'none' : 'block';


    let old_active = document.querySelector('.item.active');
    if(old_active) old_active.classList.remove('active');
    items[active].classList.add('active');

     leftTransform = width_item * (active - 1) * -1;
    list.style.transform = `translateX(${leftTransform}px)`;
}
runCarousel();
    </script>

    <script>
        let num = 2;

document.addEventListener('DOMContentLoaded', function() {
    toggleHiddenClass();

    document.getElementById('prev').addEventListener('click', function() {
        toggleHiddenClass(-1);
    });

    document.getElementById('next').addEventListener('click', function() {
        toggleHiddenClass(+1);
    });
});

function toggleHiddenClass(offset=0) {
    num += offset;

    console.log(num);
    if(num < 1){
        num = 1;
    } else if(num > 3){
        num = 3;
    }
    if(num < 1){
        num = 1;

    } else if(num > 3){
        num = 3;

    }
    const activeMenuItem = document.querySelector('.menus .list .item.active');

    if (!activeMenuItem) {
        console.log(".menus .list .item.active bulunamadı.");
        return;
    }

    const activeMenuId = activeMenuItem.getAttribute('id');
    console.log(activeMenuId);
    if (!activeMenuId) {
        console.log("Active menu item için id bulunamadı.");
        return;
    }

    const verticalMenuContent = document.querySelector(`.menu-content#${activeMenuId}`);
    console.log(verticalMenuContent);
    if (!verticalMenuContent) {
        console.log("Vertical menu content bulunamadı.");
        return;
    }

    const matchedElements = document.querySelectorAll(".vertical-menu .menu-content:not(.hidden)");
    matchedElements.forEach(function(element) {
        element.classList.add('hidden');
    });
  
    verticalMenuContent.classList.remove("hidden");
}
</script>
<script>
function addToCart(name, price, id) {
    var formData = new FormData();
    formData.append('name', name);
    formData.append('price', price);
    formData.append('id', id);
    console.log(name, price, id);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'add_cart.php', true);
    xhr.onload = function () {
        console.log('Status:', xhr.status);
        console.log('Response:', xhr.responseText);
        if (xhr.status === 200) {
            console.log('The product has been added to the cart!');
            updateCartCount();
        } else {
            console.log('An error occurred, please try again.');
        }
    };
    xhr.onerror = function () {
        console.error('Request error...');
    };
    xhr.send(formData);
}
function updateCartCount() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_itemCount.php', true);
    xhr.onload = function() {
        if (this.status == 200) {
            document.querySelector('.cart-icon .item-count').textContent = this.responseText;
        }
    };
    xhr.send();
}
</script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>