<?php
    session_start();
    $conn=mysqli_connect('localhost','root','','food court');
    
    if(isset($_POST['vendorid'])&&isset($_POST['info'])){
        $id=$_POST['vendorid'];
        $sql="SELECT * FROM `userview` WHERE vendor_id='$id'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_all($result);
        echo json_encode($row);
    }
    if(isset($_POST['find'])){
        $id=$_POST['vendorid'];
        $sql="SELECT DISTINCT category FROM userview WHERE VENDOR_ID=$id";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_all($result);
        echo json_encode($row);
    }
    if(isset($_POST['show'])){
        $id=$_POST['vendorid'];
        $sql="SELECT * FROM `userview` WHERE VENDOR_ID =$id ORDER BY category;";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_all($result);
        echo json_encode($row);
    }
    if(isset($_POST['foodid'])){
        $id=$_POST['vendorid'];
        $foodid=$_POST['foodid'];
        $sql="SELECT * FROM `userview` WHERE VENDOR_ID =$id and FOOD_ID=$foodid";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_all($result);
        echo json_encode($row);
    }
    if(isset($_POST['owninfo'])){
        $id=$_SESSION["id"];
        $sql="SELECT contuct_number, address FROM customers WHERE id =$id;";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_all($result);
        echo json_encode($row);
    }
    if(isset($_POST['text'])){
        $id=$_POST['vendorid'];
        $foodOrCat=$_POST['text'];
        $sql="SELECT * FROM `userview` WHERE VENDOR_ID = $id AND (FOOD_NAME LIKE '%$foodOrCat%' OR category LIKE '%$foodOrCat%');";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_all($result);
        echo json_encode($row);
    }
    
?>