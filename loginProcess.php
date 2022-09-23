<?php
    if(session_status()>0){
        session_start();
        $Email=$_SESSION["email"];
        $pass=$_SESSION["password"];
        $conn=mysqli_connect('localhost','root','','food court');
        if(!$conn){
            die("Connection failed ".mysqli_connect_error());
        }
    $sql="SELECT * FROM userslogininfo WHERE email='$Email'  AND password='$pass'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)==0){
        $_SESSION["status"]="Incorrect Email or Password.";
        header("Location:login.php");
    }else{
        $row = mysqli_fetch_assoc($result);
        if($row["rule"]=="customer"){
            session_unset();
            $sql="SELECT * FROM customers WHERE email='$Email'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
            $_SESSION["id"]=$row["id"];
            $_SESSION["first_name"]=$row["first_name"];
            $_SESSION["last_name"]=$row["last_name"];
            $_SESSION["contuct_number"]=$row["contuct_number"];
            $_SESSION["address"]=$row["address"];
            $_SESSION["email"]=$row["email"];
            $_SESSION["rule"]="customer";
            header("Location:customerdashbord.php");
        }elseif($row["rule"]=="vendor"){
            session_unset();
            $sql="SELECT * FROM vendors WHERE email='$Email'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
            $_SESSION["id"]=$row["id"];
            $_SESSION["name"]=$row["name"];
            $_SESSION["logo"]=$row["logo"];
            $_SESSION["rule"]="vendor";
            header("Location:businessAccountDashbord.php");
        }
    }
}else{
    header("Location:login.php");
}
mysqli_close($conn);
?>