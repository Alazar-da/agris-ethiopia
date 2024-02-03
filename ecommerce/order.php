<?php
session_start();
$name="";
$name=$_SESSION["name"];
if(empty($name)){
    header("location:index.php");
}
include 'data/conn.php';

        $seller_name="";
        $product_name="";
        $type="";
        $image="";
        $price="";
        $discription="";
        $amount="";
        $by="";

$sql = "SELECT * FROM product_sell";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $id=$row['id'];
    if (isset($_POST[$id])) {
        $seller_name=$row['seller_name'];
        $product_name=$row['product_name'];
        $type=$row['type'];
        $image=$row["img"];
        $price=$row['price'];
        $discription=$row['description'];
        $amount=$row['amount'];
        $by=$row['by'];
        
        $_SESSION["seller_name"]=$seller_name;
        $_SESSION["id"]=$id;

    }
  }
}
if ($seller_name=="") {
  header('location:dashboard.php');
}

if(isset($_POST['submit']) && isset($_POST['amount'])){
    $amount=$_POST['amount'];

    $seller_name=$_SESSION["seller_name"];
    $id=$_SESSION["id"];

    $sql="INSERT INTO `order`(`product_id`, `seller_name`, `buyer_name`,`buy_amount` ) VALUES ('$id','$seller_name','$name','$amount')";
    if ($conn->multi_query($sql) === TRUE) {
        $sql2 = "UPDATE product_sell SET status='ordered' WHERE id='$id'";

if ($conn->query($sql2) === TRUE) {
  header('location:dashboard.php');
} else {
  echo "Error updating record: " . $conn->error;
}
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
 
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Order</title>
</head>
<body class="bg-light">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center" >
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap px-4 py-3 my-4 border" style="background-color: #00ACAB;">
                    <div class="icon mb-4 d-flex align-items-center">
                            <a href="dashboard.php" class="btn btn-outline-light" style="height: 60px; width:50px;"><i style="font-size: 2rem;" class="bi bi-arrow-bar-left"></i></a>
                        </div>
                        
                        <div class="card text-white" style="background-color: #00ACAB;">
                        <img src="uploads/<?php echo $image;?>" style="max-height:250px" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo "Product Name " . $product_name;?></h5>
                            <h6 class="card-title"><?php echo"Product Type  ". $type;?></h6>
                            <p class="card-text"><?php echo"Price  ". $price."/$by";?> Birr </p>
                            <p class="card-text"><?php echo"Discription  ". $discription;?></p>
                            <form action="order.php" method="post">
                            <div class="form-group d-flex">
                              <div class="p-2">
                                <input type="number" name="amount" class="form-control rounded-left" required max="<?php echo $amount;?>" name="value" id="">
                              </div>
                              <div class="p-2 mt-2">
                                <h6> in/<?php echo $amount.$by;?></h6>
                              </div>


                              
                            </div>  
                            <input type="submit" class="btn btn-outline-light" value="order" name="submit">
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>