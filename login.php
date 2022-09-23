<?php
session_start();
    $email=$emailErr=$pass=$passErr="";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
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
    if(empty($_POST['password'])){
        $passErr="Fill password*";
    }else{
            $pass=test_input($_POST['password']);
            $_SESSION["password"]=$pass;
    }
}
if(!empty($email) and !empty($pass)){
    header("Location: loginProcess.php");
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
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="login.css">
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
        <h3><?php if(isset($_SESSION["status"])){
            echo $_SESSION["status"];
            session_destroy();
        }
        if(isset($_SESSION["success"])){
            echo $_SESSION["success"];
            session_destroy();
        }
        ?></h3>
            <div id="transparent">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                    <label>Email</label><br><input type="text" name="email" value="<?php echo $email;?>"><br>
                    <span><?php echo $emailErr."<br>"; ?></span><br>
                    <label>Password</label><br><input type="password" name="password"><br>
                    <span><?php echo $passErr."<br>"; ?></span><br>
                    <button type="submit" id="Loginbtn">Login</button>
                </form>
                <br>
                <p class="container">Need an account? <a href="User_Registration_Form.php">Click Here..</a></p>
            </div>
    </section>
    </body>
</html>