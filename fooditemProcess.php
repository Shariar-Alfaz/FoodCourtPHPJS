<?php
    if(session_status()>0){
        session_start();
        if(isset($_SESSION["id"]) and $_SESSION["rule"]=="vendor"){
            $food_name=$_SESSION["food_name"];
            $price=$_SESSION["price"];
            $picture=$_SESSION["file"];
            $description=$_SESSION["description"];
            $vendor_id=$_SESSION["id"];
            $category=$_SESSION["category"];
            $conn=mysqli_connect("localhost","root","","food court");
            if(!$conn){
                die("Connection failed ".mysqli_connect_error());
            }
                $sql="INSERT INTO `fooditems`(`vendor_id`, `name`, `price`, `picture`, `description`, `category`) VALUES ('$vendor_id','$food_name','$price','$picture','$description','$category')";
            }
            if(mysqli_query($conn,$sql)){
                header("Location:businessAccountDashbord.php");
            }else{
                echo "Error updating record: " .mysqli_error($conn);
                header("refresh:3;url= businessAccountDashbord.php");
            }
        }else{
        session_unset();
        session_destroy();
        header("Location:login.php");
    }
?>