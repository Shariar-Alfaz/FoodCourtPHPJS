<?php
    session_start();
    $Resturant_name=$_SESSION["Resturant_name"];
    $Email=$_SESSION["email"];
    $Password=$_SESSION["password"];
    $Address=$_SESSION["address"];
    $ContuctNumber=$_SESSION["contuctNum"];
    $Image=$_SESSION["file"];
    echo gettype($Image);
    $conn=mysqli_connect('localhost','root','','food court');
    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql="SELECT * FROM `vendors` WHERE email = '$Email'";
    $result=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
        session_unset();
        $_SESSION["prevAccount"]="true";
        header("Location: businessAccount.php");
    }else{
        $sql="INSERT INTO `vendors`(`name`, `address`, `contuctNumber`, `email`, `password`, `logo`) VALUES ('$Resturant_name','$Address','$ContuctNumber','$Email','$Password','$Image')";
        $sql2="INSERT INTO userslogininfo (email,password,rule) VALUES ('$Email','$Password','vendor')";
        if(mysqli_query($conn,$sql) and mysqli_query($conn, $sql2)){
            echo "Succsessfully registerd.<br> Need to login now.";
            session_destroy();
            header("refresh:3;url=login.php");
            
        }else{
            echo "Error: <br>" . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
?>