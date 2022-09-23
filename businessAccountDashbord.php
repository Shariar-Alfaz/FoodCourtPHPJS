<?php
session_start();

if(!isset($_SESSION["id"])and $_SESSION["rule"]!="vendor"){
    header("location:login.php");
    session_destroy();
}
$logo=$_SESSION["logo"];
$id=$_SESSION["id"];
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>
            <?php echo $_SESSION["name"];?>
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="businessAccountDashbord.css">
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
        <header id="logo-name">
            <img src="<?php echo $logo;?>" alt="Avatar" id="logo">
            <h2 id="res">
                <?php echo $_SESSION["name"];?>
            </h2>
        </header>
        <br>

        <br>
        <section class="container">
            <h4 class="h4" style="text-align:center;">Category</h4>
            <br>
            <div id="categorylist"></div>
        </section>
        <section class="container">
            <h4 class="h4">Food items</h4>
            <hr>
            <br>
            <div class="container center">
                <button id="addFood"><i class="fas fa-plus"></i> Add food</button>
            </div><br>
            <div id="foodflex"></div>
        </section>


        <div id="modal-edit">
            <div id="modal-content">
                <div class="c-c">
                <p id="modal-close-btn">X</p>
                <img id="modal-content-img" src="">
                <hr>
                <form name="foodAddForm">
                    <p>Food name:</p>
                    <input type="text" name="foodName" pattern="[A-Z a-z|0-9|]*" title="Could not contain spacial charecters." id="foodName" required>
                    <p>Description:</p>
                    <textarea name="" id="details" cols="30" rows="10" pattern="[A-Za-z|0-9]* title=" Could not contain spacial charecters. " required></textarea>
                <p>Category:</p>
                <input type="text" name="foodCategory "pattern="[A-Z a-z|0-9]*" title="Could not contain spacial charecters." id="cat" required>
                <p>Price:</p>
                <input type="text" name="price" id="price" pattern="[0-9]*" title="Could not contain letters. " required><br><br>
                </form>
                <button id="update">Update</button>
                </div>    
            </div>
        </div>
        <div id="modalnotifi">
            <div id="m2content">
                <p id="m2close">X</p>
                <h2 id="m2message"><h2>
            </div>
        </div>
        <div id="addModal">
            <div id="addModalContent">
                <p id="addclose">X</p>
                <form name="newAddForm" enctype="multipart/form-data" action="addf.php" method="POST">
                    <p>Food name:</p>
                    <input type="text" name="foodName" pattern="[A-Z a-z|0-9|]*" title="Could not contain spacial charecters." id="foodName-add" required>
                    <p>Description:</p>
                    <textarea name="des" id="details-add" cols="30" rows="10" pattern="[A-Z a-z|0-9]* title=" Could not contain spacial charecters." required></textarea>
                <p>Category:</p>
                <input type="text" name="foodCategory" pattern="[A-Z a-z|0-9]*" title="Could not contain spacial charecters. " id="cat-add" required>
                <p>Price:</p>
                <input type="text" name="price" id="price-add" pattern="[0-9]*" title="Could not contain letters." required><br><br>
                <p>Food image</p>
                <input type="file" name="file" id="file"  accept="image/*" required><br>
                <div id="preview">
                        <img class="image" src="" alt="Image Preview">
                        <span class="image-text">Image preview</span>
                    </div>
                    <br>
                    <p></p>
                    <br>
                    <button type="submit" id="add" name="submit">Add</button>
                </form>
            </div>
        </div>
        <script src="js/businessdashbord.js "></script>
        <script src="js/businessAccount.js"></script>
        <script src="js/nav.js"></script>
    </body>
    </html>