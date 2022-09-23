<?php
     $Resturant_name= $address= $contuctNum= "";
     $email= $pass= $Resturant_nameErr= $addressErr= $contuctNumErr="";
     $emailErr= $passErr= $fileErr="";
     $javas="showPreview(event);";
    //Input validation
    session_start();
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($_POST['Resturant_name'])){
            $Resturant_nameErr="Please fill this field*";
        }else{
            if(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['Resturant_name'])){
                $Resturant_nameErr="Only letters and white spaces are allowed*";
            }else{
                $Resturant_name=test_input($_POST['Resturant_name']);
                $_SESSION["Resturant_name"]=$Resturant_name;
            }
        }
    

        if(empty($_POST['contuctNumber'])){
            $contuctNumErr="Contuct number is required*";
        }else{
            if(preg_match("/^[0-9]*$/",$_POST['contuctNumber']) and strlen($_POST['contuctNumber'])==11 and substr($_POST['contuctNumber'],0,2)=="01"){
                $contuctNum=test_input($_POST['contuctNumber']);
                $_SESSION["contuctNum"]=$contuctNum;
            }else{
                $contuctNumErr="Fill contuct number properly*";
            }
        }
        if(empty($_POST['email'])){
            $emailErr="Email can not be empty*";
        }else{
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $emailErr="Enter email properly*";
            }else{
                $email=test_input($_POST['email']);
                $_SESSION["email"]=$email;
            }
        }
        if(empty($_POST['address'])){
            $addressErr="Fill address properly*";
        }else{
            $address=test_input($_POST['address']);
            $_SESSION["address"]=$address;
        }
        if(empty($_POST['password'])){
            $passErr="Fill password*";
        }else{
            if(strlen($_POST['password'])<7){
                $passErr="Password minimum lenght shuld be 8 charecters*";
            }elseif($_POST['password']!=$_POST['confirmPassword']){
                $passErr="Password does not match*";
            }else{
                $pass=test_input($_POST['password']);
                $_SESSION["password"]=$pass;
            }
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
    if(!empty($Resturant_name) and !empty($address) and !empty($email) and !empty($pass) and !empty($contuctNum) and isset($_SESSION["file"])){
        header("Location: businessAccountDataProcess.php");
    }
    function test_input($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Business account registration</title>
        <link rel="stylesheet" href="businessReg.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    </head>
    <body>
    <header id="login_header">
        <br>
            <div class="container">
                <img src="image/logo.png" width="180" height="180" id="header_img">
                <h1>Food Court</h1>
            </div>
    </header>
    <section id="form-section">
            <h2>Business Account Registration</h2>
            <h2>
                <?php if(isset($_SESSION["prevAccount"])){
                echo "*This email already registered with an account*";
                session_destroy();
            }?>
            </h2>
            <div id="transparent">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">
                    <label>Resturant name</label><br>
                    <input type="text" name="Resturant_name" value="<?php echo $Resturant_name;?>"><br>
                    <span class="error"><?php echo $Resturant_nameErr."<br>";?></span><br>


                    <label>Contuct Number</label><br>
                    <input type="text" name="contuctNumber" value="<?php echo $contuctNum;?>"><br>
                    <span class="error"><?php echo $contuctNumErr."<br>";?><br>

                    <label>Email</label><br>
                    <input type="text" name="email" value="<?php echo $email;?>"><br>
                    <span class="error"><?php echo $emailErr."<br>";?><br>

                    <label>Address</label><br>
                    <input type="text" name="address" value="<?php echo $address;?>"><br>
                    <span class="error"><?php echo $addressErr."<br>";?><br>

                    <label>Password</label><br>
                    <input type="password" name="password" value="<?php echo $pass;?>"><br>
                    <span class="error"><?php echo $passErr."<br>";?><br>

                    <label>Confirm Password</label><br>
                    <input type="password" name="confirmPassword"><br><br>

                    <label>Resturant logo</label><br>
                    <input type="file" name="file" id="file"  accept="image/*">
                    <br>
                    <div id="preview">
                        <img class="image" src="" alt="Image Preview">
                        <span class="image-text">Image preview</span>
                    </div>
                    <span class="file-error"><?php echo $fileErr."<br>";?><br>
                    <button type="submit" id="regConfirmBtn" value="submit">Confirm</button>
                   
                </form>
                <script src="js/businessAccount.js"></script>
            </div>
    </section>
    <br>
    </body>
</html>