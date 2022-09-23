<?php 
    session_start();
    if(!isset($_SESSION["id"])and $_SESSION["rule"]!="vendor"){
        header("location:login.php");
        session_destroy();
    }
    $food_name=$category=$description=$price="";
    $food_nameErr=$categoryErr=$priceErr=$fileErr="";
    if(isset($_SESSION["id"])){
        $vendor_id=$_SESSION["id"];
        $logo=$_SESSION["logo"];
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($_POST['food_name'])){
            $food_nameErr="Please fill this field*";
        }else{
            if(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['food_name'])){
                $food_nameErr="Only letters and white spaces are allowed*";
            }else{
                $food_name=test_input($_POST['food_name']);
                $_SESSION["food_name"]=$food_name;
            }
        }
    
        if(empty($_POST['category'])){
            $categoryErr="Category can not be empty*";
        }else{
            if(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['category'])){
                $categoryErr="Only letters and white spaces are allowed*";
            }else{
                $category=test_input($_POST['category']);
                $_SESSION["category"]=$category;
            }
        }
        if(empty($_POST['price'])){
            $priceErr="Fill price properly*";
        }else{
           if(!is_float((float)$_POST['price'])){
               $priceErr="Only decimal values are allowed*";
           }else{
               $price=test_input((float)$_POST['price']);
               $_SESSION["price"]=$price;
           }
        }
        if(!empty($_POST['description'])){
            $description=test_input($_POST['description']);
            $_SESSION["description"]=$description;
        }
        if(empty($_FILES["file"]["name"])){
            $fileErr="Image does not selected*";
        }else{
            $targetdir="upload/";
            $tempImage=$targetdir.basename($_FILES["file"]["name"]);
            $imageFileType=strtolower(pathinfo($tempImage, PATHINFO_EXTENSION));
            if( getimagesize($_FILES["file"]["tmp_name"])==false){
                $fileErr="Uploaded file is not an imgae*";
            }
            elseif($_FILES["file"]["size"]>500000){
                $fileErr="Image is too lage. Maximum size is 5mb*";
            }
            elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"){
                $fileErr="Sorry, only JPG, JPEG, PNG & GIF files are allowed*";
            }else{
                move_uploaded_file($_FILES["file"]["tmp_name"], $tempImage);
                $_SESSION["file"]=$tempImage;
            }
        }

    }
    function test_input($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
if(!empty($food_name) and !empty($category)and !empty($price)){
    header("Location:fooditemProcess.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $_SESSION["name"];?></title>
        <link rel="stylesheet" href="businessAccountDashbord.css">
    </head>
    <body>
        <header id="bhead">
            <nav id="bnav">
                <div id="center-item">
                    <ul id="nav-ul">
                        <li>Food Court</li>
                        <li><a href="logoutProcess.php">Logout</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <br><br><br><br><br>
        <section id="logo-name">
            <img src="<?php echo $logo;?>"alt="Avatar" id="logo" width="200px">
            <h2><?php echo $_SESSION["name"];?></h2>
        </section>
        <section class="container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">

            <label>Food name</label><br>
            <input type="text" name="food_name" value="<?php echo $food_name;?>"><br>
                    <span class="error"><?php echo $food_nameErr."<br>";?></span><br>


                    <label>Category</label><br>
                    <input type="text" name="category" value="<?php echo $category;?>"><br>
                    <span class="error"><?php echo $categoryErr."<br>";?><br>

                    <label>Price</label><br>
                    <input type="text" name="price" value="<?php echo $price;?>"><br>
                    <span class="error"><?php echo $priceErr."<br>";?><br>

                    <label>Description</label><br>
                    <textarea name="description" rows="5" cols="50" value="<?php echo $description;?>"></textarea><br>

                    <label>Picture</Picture></label><br>
                    <input type="file" name="file" id="file" value="<?php echo $picture;?>"><br>
                    <span class="error"><?php echo $fileErr."<br>";?><br>
                    <button type="submit" id="regConfirmBtn" value="submit">Confirm</button>
            </form>
        </section>
    </body>
</html>