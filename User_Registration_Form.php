<?php
    $fname= $lname= $address= $contuctNum= $Gender= "";
    $email= $pass= $fnameErr= $lnameErr= $addressErr= $contuctNumErr="";
    $GenderErr= $emailErr= $passErr="";
    //Input validation
    session_start();
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($_POST['first_name'])){
            $fnameErr="Please fill this field*";
        }else{
            if(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['first_name'])){
                $fnameErr="Only letters and white spaces are allowed*";
            }else{
                $fname=test_input($_POST['first_name']);
                $_SESSION["fname"]=$fname;
            }
        }
        if(empty($_POST['last_name'])){
            $lnameErr="Please fill this field*";
        }else{
            if(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['last_name'])){
                $lnameErr="Only letters and white spaces are allowed*";
            }else{
                $lname=test_input($_POST['last_name']);
                $_SESSION["lname"]=$lname;
            }
        }
        if(empty($_POST['gender'])){
            $GenderErr="Gender is required*";
        }else{
            $Gender=test_input($_POST['gender']);
            $_SESSION["gender"]=$Gender;
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
        
    }
    if(!empty($fname) and !empty($lname) and !empty($address) and !empty($email) and !empty($pass) and !empty($contuctNum) and !empty($Gender)){
        header("refresh: 0; url=regDataProcess.php");
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
        <title>User Registration</title>
        <link rel="stylesheet" href="userRegistration.css">
    </head>
    <body>
        <header id="login_header">
            <div class="container">
                <img src="image/logo.png" width="250" height="250" id="header_img">
                <h1>Food Court</h1>
            </div>
        </header>
        <section id="reg-form">
            <h2>User Registration Form</h2>
            <h2>
                <?php if(isset($_SESSION["prevAccount"])){
                echo "*This email already registered with an account*";
                session_destroy();
            }?>
            </h2>
            <div id="transparent">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                    <label>First Name</label><br>
                    <input type="text" name="first_name" value="<?php echo $fname;?>"><br>
                    <span class="error"><?php echo $fnameErr."<br>";?></span><br>

                    <label>Last Name</label><br>
                    <input type="text" name="last_name" value="<?php echo $lname;?>"><br>
                    <span class="error"><?php echo $lnameErr."<br>";?></span><br>

                    <label>Gender</label><br><br>
                    <input type="radio" name="gender"<?php if(isset($Gender) and $Gender=="Male") echo "checked";?> value="Male">Male
                    <input type="radio" name="gender"<?php if(isset($Gender) and $Gender=="Female") echo "checked";?>value="Female">Female
                    <input type="radio" name="gender"<?php if(isset($Gender) and $Gender=="Other") echo "checked";?>value="Other">Other<br>
                    <span class="error"><?php echo $GenderErr."<br>";?></span><br>

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

                    <button type="submit" id="regConfirmBtn" value="submit">Confirm</button>
                </form>
            </div>
        </section>
    </body>
</html>