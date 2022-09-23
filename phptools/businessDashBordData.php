<?php
    session_start();
    $id=$_SESSION["id"];
    $conn=mysqli_connect('localhost','root','','food court');
    if(isset($_POST['category'])){
        $sql="SELECT DISTINCT category FROM fooditems WHERE vendor_id=$id ORDER BY category ASC";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_all($result);
        echo json_encode($row);
    }
    if(isset($_POST['food'])){
        $sql="SELECT * FROM fooditems WHERE vendor_id=$id ORDER BY category";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_all($result);
        echo json_encode($row);
    }
    if(isset($_POST['fid'])){
        $fid=$_POST['fid'];
        $sql="SELECT * FROM fooditems WHERE vendor_id=$id and id='$fid';";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_all($result);
        echo json_encode($row);
    }
    if(isset($_POST['update'])){
        $fid = $_POST['foodid'];
        $fname=$_POST['fname'];
        $details =$_POST['detail'];
        $cat=$_POST['cat'];
        $price=$_POST['price'];
        $sql="UPDATE `fooditems` SET `name`='$fname',`price`='$price',`description`='$details',`category`='$cat' WHERE id='$fid';";
        if(mysqli_query($conn,$sql)){
            echo json_encode("Success");
        }else{
            echo json_encode("nul");
        }
    }
    if(isset($_POST['clear'])){
        $fid = $_POST['fid'];
        $sql="DELETE FROM fooditems WHERE id='$fid';";
        if(mysqli_query($conn,$sql)){
            echo json_encode("Success");
        }else{
            echo json_encode("dead");
        }
    }

?>