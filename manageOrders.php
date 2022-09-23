<?php 
session_start();

if(!isset($_SESSION["id"])and $_SESSION["rule"]!="vendor"){
    header("location:login.php");
    session_destroy();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Orders</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="manageorder.css">
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
                        <a href="businessAccountDashbord.php"><i class="fas fa-house-user"></i> Home</a>
                        <a href="manageOrders.php" class="manageOrders"><i class="fas fa-tasks"></i> Manage orders <div class="order-notifi"></div></a>
                        <a href="logoutProcess.php" onclick="logout()"><i class="fas fa-user-alt-slash"></i> Logout, <?php if(isset($_SESSION["name"])){echo $_SESSION["name"];}?></a>
                        <a href="javascript:void(0);" class="icon" onclick="myFunction()"><i class="fa fa-bars"></i></a>
                    </div>
            </div>
        </div>
    </nav>
    <br><br><br><br>

    <head>
        <div class="text">
            <div>
                <i class="fas fa-concierge-bell"></i>
            </div>
            <div>
                <h1>Manage orders</h1>
            </div>
        </div>
    </head><br><br>
    <section class="container">
        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'Pending')" id="def">Pending</button>
            <button class="tablinks" onclick="openTab(event, 'Cooking')">Cooking</button>
            <button class="tablinks" onclick="openTab(event, 'On-the-way')">On the way</button>
            <button class="tablinks" onclick="openTab(event,'Delivered')">Delivered</button>
        </div>

        <div id="Pending" class="tabcontent">
            
        </div>

        <div id="Cooking" class="tabcontent">
        </div>

        <div id="On-the-way" class="tabcontent">
            
        </div>

        <div id="Delivered" class="tabcontent">
        </div>
    </section>
    <div id="modalnotifi">
            <div id="m2content">
                <p id="m2close">X</p>
                <h2 id="m2message"><h2>
            </div>
    </div>
    <script src="js/manageOrder.js"></script>
    <script src="js/businessdashbord.js"></script>
    <script src="js/nav.js"></script>
</body>

</html>