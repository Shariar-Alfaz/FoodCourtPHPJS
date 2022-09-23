<?php
    session_start();
    if(!isset($_SESSION["id"])||isset($_SESSION["rule"])!="customer"){
        header("Location:index.html");
    }
?>
<!DOCTYPE html>
<html>

<head>
    <title>Cart</title>
    <link rel="stylesheet" href="cart.css">
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
    <br><br><br><br><br><br><br>
    <div class="container">
        <h2 id="restaurent-name"></h2>
        <hr>
        <div id="add"></div>
        <div class="calculation">
            <table>
                <tr>
                    <td> Subtotal</td>
                    <td id="subtotal"></td>
                </tr>
                <tr>
                    <td>Vat(10%)</td>
                    <td id="vat"></td>
                </tr>
                <tr>
                    <td>Grand total</td>
                    <td id="grand-total"></td>
                </tr>
            </table>
        </div>
        <br><br>
        <aside class="corner">
        <label for="contuct-number">Phone:</label><br>
                    <input type="tel" id="contuct-number"><br><br>
                    <label for="address">Address: </label><br>
                    <input type="address" id="address"><br><br>
            <button id="Clear"><i class="fas fa-trash-alt"></i> Clear cart</button>
            <button id="confirm">Confirm</button>
        </aside>
        <div id="modalnotifi">
            <div id="m2content">
                <p id="m2close">X</p>
                <h2 id="m2message"><h2>
            </div>
        </div>
    </div>
    <script src="js/cartload.js"></script>
    <script src="js/nav.js"></script>
</body>


</html>