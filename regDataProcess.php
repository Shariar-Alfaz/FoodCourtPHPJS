<?php
    if(session_status()>0){
        session_start();
    $First_Name=$_SESSION["fname"];
    $Last_Name=$_SESSION["lname"];
    $Email=$_SESSION["email"];
    $Password=$_SESSION["password"];
    $Address=$_SESSION["address"];
    $ContuctNumber=$_SESSION["contuctNum"];
    $Gender=$_SESSION["gender"];
    $conn=mysqli_connect('localhost','root','','food court');
    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql="SELECT * FROM `customers` WHERE email = '$Email'";
    $result=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
        session_unset();
        $_SESSION["prevAccount"]="true";
        header("refresh:0.05; url=User_Registration_Form.php");
    }else{
        $sql="INSERT INTO customers (first_name,last_name,email,contuct_number,password,address,gender) VALUES ('$First_Name','$Last_Name','$Email','$ContuctNumber','$Password','$Address','$Gender')";
        $sql2="INSERT INTO userslogininfo (email,password,rule) VALUES ('$Email','$Password','customer')";
        if(mysqli_query($conn,$sql) and mysqli_query($conn, $sql2)){
           
            $_SESSION["success"] ="Registration successful. Login now.";
            header("Location:login.php");
            
        }else{
            echo "Error: <br>" . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
    }else{
        header("Location:User_Registration_Form.php");
    }
?>