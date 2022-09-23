<?php
    session_start();
    if(!isset($_SESSION["id"])||isset($_SESSION["rule"])!="customer"){
        header("Location:index.html");
    }
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Restaurent</title>
        <link rel="stylesheet" href="foods.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <br><br><br><br>
        <header class="header">
            <div class="header-flex container">
                <div>
                    <img src="" id="image">
                    
               </div>
               <div class="dev"></div>
                <div id="info">
                    <h1 id="name"></h1>
                </div>
            </div>
        </header>
        <section class="container food-search">
            <h1>Looking for foods?</h1>
            <div class="search-bar">
                <input type="text" placeholder="Search here"id="search-input" oninput="findfood()">

                <button type="submit" id="search-btn"onclick="findfood()" ><i class="fas fa-search" id="icon"></i></button>
                <button id="category-btn"><i class="fas fa-tasks"></i></button>
            </div>
            <br><br>
            <div id="category-list"> 
                <h3>Category</h3> 
                <hr>
            </div>
            <div id="restaurent-search">
                <h3>Results</h3>
                <hr>
                <p id="nodata">No data found</p>
                <div id="result"></div> 
                <div id="space"><div>
            <div>
        </section>
        <br><br>
        <section class="container">
        <h3 id="h3cen">Food items</h3>
        <hr>
        <div class="flex"></div>        
        <div id="modal">
            <div id="modal-content">
                <p id="modal-close-btn">X</p>
                <img id="modal-content-img" src="">
                <h2 id="restaurentname"><h2>
                <hr>
                <h1 id="food-name"></h1>
                <p id="description"></p>
                <p id="price"><sapn style="color:rgb(182, 182, 182);">(per.)</sapn></p>
                    <label for="quantity">Add quantity <span style="color:rgb(182, 182, 182);">(minimum 1.)</span>:</label><br>
                    <input type="number" min="1" step="1" value="1" id="quantity">
                    <br><br>
                    <label for="details">Add your instructions <sapn style="color:rgb(182, 182, 182);">(optional.)</sapn>:</label><br>
                    <textarea id="details"></textarea><br><br>
                    <div id="error-message">
                        
                    </div><br><br>
                    <button id="add-to-cart">+ Add to cart</button>
                    <button id="modal-close-btn-2">Close</button>
            </div>
        </div>
        <div id="modalnotifi">
            <div id="m2content">
                <p id="m2close">X</p>
                <h2 id="m2message"><h2>
            </div>
        </div>
        
        <script src="js/foods.js"></script>
        <script src="js/style.js"></script>
        <script src="js/logout.js"></script>
        <script src="js/cartadd.js"></script>
        <script src="js/nav.js"></script>
    </body>
    </html>