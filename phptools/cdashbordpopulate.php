<?php
    header("Content-Type: application/json; charset=UTF-8");
    $conn=mysqli_connect("localhost","root","","food court");
    $sql="SELECT * FROM `vendors`;";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_all($result);
    echo json_encode($row);
?>