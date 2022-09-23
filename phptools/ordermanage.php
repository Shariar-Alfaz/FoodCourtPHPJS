<?php
session_start();
date_default_timezone_set("Asia/Dhaka");
$conn=mysqli_connect('localhost','root','','food court');
    if(isset($_POST['items'])){
        $items=json_decode($_POST['items']);
        $id=$_SESSION["id"];
        $address=$_POST['address'];
        $phone=$_POST['phone'];
        $orderid = uniqid();
        $date=date("Y-m-d");
        $time=date("H:i:s");
        $trak=FALSE;
        foreach($items as $item){
            $sql="INSERT INTO `orders`( `customer_id`, `vendor_id`, `delivary_location`, `food_id`, `quantity`, `order_id`, `instructions`, `date`, `time`, `customer_number`, `status`, `subtotal`) VALUES ('$id','$item->restaurentId','$address','$item->foodId','$item->foodQuantity','$orderid','$item->orderDes','$date','$time','$phone','Pending','$item->subtotal');";
            if(mysqli_query($conn,$sql)){
                $trak=TRUE;
            }else{
                $ma="Error updating record: " .mysqli_error($conn);
            }
        }
        if($trak){
            echo json_encode("Order placed.");
        }else{
            echo json_encode("Something wrong!!");
        }
    }
    if(isset($_POST['pending'])){
        $id=$_SESSION["id"];
        $sql="SELECT * FROM `customerorderview` WHERE status IN ('pending', 'cooking','on the way') and customer_id = '$id' ORDER BY order_id;";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_all($result);
        echo json_encode($row);
    }
    if(isset($_POST['delivered'])){
        $id=$_SESSION["id"];
        $sql="SELECT * FROM `customerorderview`where customer_id = '$id' and status = 'delivered' ORDER BY (date + time) DESC;";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_all($result);
        echo json_encode($row);
    }
    
?>