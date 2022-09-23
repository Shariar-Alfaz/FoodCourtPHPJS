<?php
    session_start();
    if(!isset($_SESSION["id"])||isset($_SESSION["rule"])!="customer"){
        header("Location:index.html");
    }
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Dash bord</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="customerdashbord.css">
        <script src="https://kit.fontawesome.com/bdffe34037.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Parisienne&display=swap" rel="stylesheet">
    </head>

    <body>
        <nav class="navbar">
            <div class="navflex container">
                <div>
                    <img src="image/logo.png" height="40" width="40">
                </div>
                <div>
                    <h3>Food Court</h3>
                </div>
                <div>
                    <div class="topnav" id="myTopnav">
                        <a href="customerdashbord.php"><i class="fas fa-house-user"></i> Home</a>
                        <a href="cart.php" class="show-cart"><i class="fas fa-cart-arrow-down"></i> Cart <div class="cart-count"></div></a>
                        <a href="myorders.php"><i class="fas fa-list"></i> My orders</a>
                        <a href="logoutProcess.php" onclick="logout()"><i class="fas fa-user-alt-slash"></i> Logout, <?php if(isset($_SESSION["last_name"])){echo $_SESSION["last_name"];}?></a>
                        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>
                    </div>
                </div>
            </div>
        </nav>
        <br><br><br><br><br><br><br>
        <header class="container">
            <h1 class="tag">Find the best restaurent here.</h1>
            <br><br><br><br>
            <div class="search-bar">

                <input type="text" placeholder="Search restaurant" id="search-input" oninput="resultDisplay()">

                <button type="submit" id="search-btn" onclick="resultDisplay()"><i class="fas fa-search" id="icon"></i></button>
            </div>
            <br><br><br>
            <div id="restaurent-search">
                <p id="closesb">X</p>
                <h3>Results</h3>
                <hr>
                <p id="nodata">No data found</p>
                <div id="result"></div>
                <div id="space">
                </div>
            </div>
        </header>
        <br><br>
        <section class="container restaurant">
            <h1>Restaurants</h1>
            <hr>
            <div id="restaurant-container"></div>
        </section>
        <br><br>
        <footer>
            <p>&copy; Food Court</p>
        </footer>
        
        <script src="js/csearch.js"></script>
        <script src="js/style.js"></script>
        <script src="js/customerdashbordpopulate.js"></script>
        <script src="js/logout.js"></script>
        <script src="js/cartadd.js"></script>
        <script src="js/nav.js"></script>
    </body>

    </html>