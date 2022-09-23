<?php
    header("Content-Type: application/json; charset=UTF-8");
    $obj=json_decode($_POST['x'],false);
    $conn=mysqli_connect("localhost","root","","food court");
    $sql="SELECT * FROM `vendors` where name like '%$obj->text%'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_all($result);
    echo json_encode($row);
?>