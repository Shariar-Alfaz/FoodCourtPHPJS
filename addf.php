<?php
session_start();
if(isset($_POST['submit'])){
    $targetdir="upload/";
    $tempImage=$targetdir.basename($_FILES["file"]["name"]);
    if(move_uploaded_file($_FILES["file"]["tmp_name"], $tempImage)){
        $conn=mysqli_connect('localhost','root','','food court');
        $pic=$tempImage;
        $vid=$_SESSION["id"];
        $name=$_POST['foodName'];
        $des=$_POST['des'];
        $cate=$_POST['foodCategory'];
        $price=$_POST['price'];
        $sql="INSERT INTO `fooditems`(`vendor_id`, `name`, `price`, `picture`, `description`, `category`) VALUES ('$vid','$name','$price','$pic','$des','$cate')";
        if(mysqli_query($conn,$sql)){
            header("Location:businessAccountDashbord.php");
        }else{
            echo "Error: <br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }else{
        echo "ree";
    }
    
   
    
 }
