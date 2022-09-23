<?php
session_start();
$id = $_SESSION["id"];
$conn=mysqli_connect('localhost','root','','food court');
if(isset($_POST['pending'])){
    $sql="SELECT * FROM `vendororderview` WHERE status ='Pending' and vendor_id='$id' ORDER BY order_id;";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_all($result);
    echo json_encode($row);
}
if(isset($_POST['cooking'])){
    $orderid=$_POST['order_id'];
    $sql="UPDATE `orders` SET `status`='Cooking' WHERE order_id='$orderid'";
    if(mysqli_query($conn,$sql)){
        echo json_encode($orderid." is cooking.");
    }else{
        echo json_encode("Something wrong in".$orderid);
    }
}
if(isset($_POST['cookinglist'])){
    $sql="SELECT * FROM `vendororderview` WHERE status ='Cooking' and vendor_id='$id' ORDER BY order_id;";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_all($result);
    echo json_encode($row);
}
if(isset($_POST['way'])){
    $orderid=$_POST['order_id1'];
    $sql="UPDATE `orders` SET `status`='On the way' WHERE order_id='$orderid'";
    if(mysqli_query($conn,$sql)){
        echo json_encode($orderid." is On the way.");
    }else{
        echo json_encode("Something wrong in".$orderid);
    }
}
if(isset($_POST['ontheway'])){
    $sql="SELECT * FROM `vendororderview` WHERE status ='On the way' and vendor_id='$id' ORDER BY order_id;";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_all($result);
    echo json_encode($row);
}
if(isset($_POST['delivered'])){
    $orderid=$_POST['order_id2'];
    $sql="UPDATE `orders` SET `status`='Delivered' WHERE order_id='$orderid'";
    if(mysqli_query($conn,$sql)){
        echo json_encode($orderid." is delivered.");
    }else{
        echo json_encode("Something wrong in".$orderid);
    }
}
if(isset($_POST['done'])){
    $sql="SELECT * FROM `vendororderview` WHERE status ='Delivered' and vendor_id='$id' ORDER BY order_id;";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_all($result);
    echo json_encode($row);
}
?>