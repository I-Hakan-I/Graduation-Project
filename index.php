<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Axsa</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/index.css">
</head>
<body style="background-image: url(img/parallax_3.jpg);">
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
                <a href="./index.php"><br>
                <h3>Axse</h3><br>
                <p>&nbsp;</p>
                </a>
            </div>
        </div>
        <div class="content">
            <section class="home" id="home">
                <div class="home-title">
                  <h1>Enjoy the taste</h1>
                  <h2>What do you want to eat today ?.</h2>
                  <a href="#" onclick="toggleNav()" class="btn">Explore the menu</a><br><br>
                </div>
                <div class="home-image">
                    <a class="home-logo"><ion-icon class="aaa" name="home-outline"></ion-icon></a>
                </div>
              </section>
              <section class="about" id="about">
                <div class="about-image">
                </div>
                <div class="about-description">
                  <span>About</span>
                  <h2>We're here</h2>
                  <p></p>
                </div>
              </section>

              <section class="services" id="services">
                <div class="heading">
                    <ion-icon class="aa" name="restaurant-outline"></ion-icon><br>
                  <span>Services</span>
                  <h2>We provide best quality food</h2>
                </div>
                <div class="services-container">
                  <div class="services-box">
                    <div class="order">
                        <ion-icon class="aa" name="basket-outline"></ion-icon>
                      <h3>Order</h3>
                      <p>Lorem ipsum dolor sit amet.</p>
                    </div>
                  </div>
                  <div class="services-box">
                    <div class="shipping">
                        <ion-icon class="aa" name="bicycle-outline"></ion-icon>
                      <h3>Shipping</h3>
                      <p>Lorem ipsum dolor sit amet.</p>
                    </div>
                  </div>
                  <div class="services-box">
                    <div class="delivery">
                        <ion-icon class="aa" name="fast-food-outline"></ion-icon>
                      <h3>Delivery</h3>
                      <p>Lorem ipsum dolor sit amet.</p>
                    </div>
                  </div>
                </div>
              </section>

              <section class="contact" id="contact">
                <div class="reservation">
                  <div class="form-title">
                    <h1><span><img src="art-1.png" alt=""></span>Make a Reservation<span><img src="art-1.png" alt=""></span></h1>
                    <p>Book your table now and have a great meal!</p>
                  </div>
                  <div class="main-form">
                    <form action="" method="post">
                      <div>
                        <span>Full name<span class="required">*</span></span>
                        <input type="text" name="name" id="name" placeholder="Write your name here..." required>
                      </div>
                      <div>
                        <span>Email<span class="required">*</span></span>
                        <input type="email" name="mail" id="mail" placeholder="Write your email here..." required>
                      </div>
                      <div>
                        <span>How many people ?<span class="required">*</span></span>
                        <select name="people" id="people" required>
                          <option value="0">0</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                        </select>
                      </div>
                      <div>
                        <span>Time<span class="required">*</span></span>
                        <input type="time" name="time" id="time" placeholder="time" required>
                      </div>
                      <div>
                        <span>Date<span class="required">*</span></span>
                        <input type="date" name="date" id="date" placeholder="date" required>
                      </div>
                      <div>
                        <span>Phone Number<span class="required">*</span></span>
                        <input type="number" name="number" id="number" placeholder="Write your number here..." required>
                      </div>
                      <div id="submit"><input type="submit" value="SUBMIT" id="number">
                      </div>
                    </form>
                  </div>
                </div>
              </section>
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
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
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
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>