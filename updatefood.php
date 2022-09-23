<?php
    session_start();
    if(session_status()==0 && $_SESSION["rule"]!="vendor"){
        session_destroy();
        header("Location:login.php");
    }
   $foodname=$price=$foodid=$category=$description=$foodnameErr=$priceErr=$categoryErr=$logo=$newfoodname=$newprice=$newdescription=$newcategory="" ;
   if(isset($_GET['food_id'])){
        $foodid=$_GET['food_id'];
        $conn=mysqli_connect("localhost","root","","food court");
        $sql="SELECT * FROM fooditems WHERE id='$foodid'";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);
        $foodname=$row["name"];
        $price=$row["price"];
        $category=$row["category"];
        $description=$row["description"];
        $logo=$row["picture"];
        mysqli_close($conn);
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($_POST['foodname'])){
            $foodnameErr="Please fill this field*";
        }else{
            if(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['foodname'])){
                $foodnameErr="Only letters and white spaces are allowed*";
            }else{
                $newfoodname=test_input($_POST['foodname']);
            }
        }
    
        if(empty($_POST['category'])){
            $categoryErr="Category can not be empty*";
        }else{
            if(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['category'])){
                $categoryErr="Only letters and white spaces are allowed*";
            }else{
                $newcategory=test_input($_POST['category']);
            }
        }
        if(empty($_POST['price'])){
            $priceErr="Fill price properly*";
        }else{
           if(!is_float((float)$_POST['price'])){
               $priceErr="Only decimal values are allowed*";
           }else{
               $newprice=test_input((float)$_POST['price']);
           }
        }
        if(!empty($_POST['description'])){
            $newdescription=test_input($_POST['description']);
        }
        if(!empty($newfoodname)&&!empty($newcategory)&&!empty($newprice)){
            $conn=mysqli_connect("localhost","root","","food court");
            $sql="UPDATE `fooditems` SET `name`='$newfoodname',`price`='$newprice',`description`='$newdescription',`category`='$newcategory' WHERE id='".$_GET["food_id"]."'";
            if(mysqli_query($conn,$sql)){
                header("Location:businessAccountDashbord.php");
            }
    }
   
}
function test_input($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}
?>
<html>
    <head>
        <title><?php echo $_SESSION["name"];?></title>
        <link rel="stylesheet" href="businessAccountDashbord.css">
    </head>
    <body>
        <header id="bhead">
            <nav id="bnav">
                <div id="center-item">
                    <ul id="nav-ul">
                        <li>Food Court</li>
                        <li><a href="logoutProcess.php">Logout</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <br><br><br><br><br>
            <h2>Edit data</h2>
        </section>
        <section class="container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?food_id=$foodid"?>" method="post"
            >

            <label>Food name</label><br>
            <input type="text" name="foodname" value="<?php echo $foodname;?>"><br>
                    <span class="error"><?php echo $foodnameErr."<br>";?></span><br>


                    <label>Category</label><br>
                    <input type="text" name="category" value="<?php echo $category;?>"><br>
                    <span class="error"><?php echo $categoryErr."<br>";?><br>

                    <label>Price</label><br>
                    <input type="text" name="price" value="<?php echo $price;?>"><br>
                    <span class="error"><?php echo $priceErr."<br>";?><br>

                    <label>Description</label><br>
                    <textarea name="description" rows="5" cols="50" ><?php echo $description;?></textarea><br>
                    <button type="submit" id="submit" value="submit">Update</button><br>
            </form>
        </section>
    </body>
</html>