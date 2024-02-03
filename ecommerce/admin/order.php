<?php
session_start();
$name=$_SESSION["name"];
include '../data/conn.php';

function getNumber($conn,$name){
    $sql = "SELECT Phone_number FROM `info` where name='$name'";
                                $result = $conn->query($sql);

                                
                                if ($result->num_rows > 0) {
                                  // output data of each row
                                  while($row = $result->fetch_assoc()) {
                                return $row['Phone_number'];
                                }
                                }

}
function getProduct($conn,$id){
    $sql = "SELECT product_name,price FROM `product_sell` where id='$id'";
                                $result = $conn->query($sql);

                                
                                if ($result->num_rows > 0) {
                                  // output data of each row
                                  while($row = $result->fetch_assoc()) {
                                 $html='<td>'.$row['product_name'].'</td><td>'.$row['price'].'</td>';
                                 return $html;
                                }
                                }

}




$sql1 = "SELECT * FROM `order`";
$result = $conn->query($sql1);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $id=$row['id'];
    $p_id=$row['product_id'];
    $b_amount=$row['buy_amount'];
if (isset($_POST[$id])) {

  $sql2 = "SELECT * FROM `product_sell` where id='$p_id'";
  $result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
  // output data of each row
  while($row2 = $result2->fetch_assoc()) {
  $f_amount=$row2['amount'];

  $x=$f_amount-$b_amount;
  if ($x==0) {

    $sql3 = "UPDATE `product_sell` SET amount='$x', status='done' WHERE id='$p_id'";
    if ($conn->query($sql3) === TRUE) {
      $sql5 = "UPDATE `order` SET status='done' WHERE id='$id'";
      if ($conn->query($sql5) === TRUE) {
        header('location:order.php');
      } else {
        echo "Error updating record: " . $conn->error;
      }
    } else {
      echo "Error updating record: " . $conn->error;
    }

  


  }else {


    $sql4 = "SELECT * FROM `order` where product_id='$p_id' and status!='done'";

    $result4 = $conn->query($sql4);

if ($result4->num_rows > 1) {
  $sql3 = "UPDATE `product_sell` SET amount='$x', status='ordered' WHERE id='$p_id'";

}
else{
  $sql3 = "UPDATE `product_sell` SET amount='$x', status='Accept' WHERE id='$p_id'";
}


    
    if ($conn->query($sql3) === TRUE) {
      $sql5 = "UPDATE `order` SET status='done' WHERE id='$id'";
      if ($conn->query($sql5) === TRUE) {
        header('location:order.php');
      } else {
        echo "Error updating record: " . $conn->error;
      }
    } else {
      echo "Error updating record: " . $conn->error;
    }
  }

  }
}





}
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
    <title>order</title>
</head>
<body class="bg-light">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center" >
                <div class="col-md-9 col-lg-12 mt-5">
                    <div class="login-wrap px-4 py-3 my-4 border" style="background-color: #00ACAB;width:fit-content;">
                        
                        <div class="icon d-flex align-items-center">
                            <a href="dashboard.php" class="btn btn-outline-light"><i style="font-size: 2rem;" class="bi bi-arrow-bar-left"></i></a>
                        </div>
                        <h3 class="text-center mb-4 text-white">Order</h3>
                        <table class="table table-dark table-striped text-white">
                            <thead>
                                <tr>
                                    <th>Buyer name</th>
                                    <th>Buyer Phone number</th>
                                    <th>Seller name</th>
                                    <th>Seller Phone number</th>
                                    <th>Product name</th>
                                    <th>Price</th>
                                    <th>Amount</th>
                                    <th>status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM  `order` where status!='done'";

                                $result = $conn->query($sql);

                                
                                if ($result->num_rows > 0) {
                                  // output data of each row
                                  while($row = $result->fetch_assoc()) {
                                    $id=$row['id'];
                                    $product_id=$row['product_id'];
                                    $seller_name=$row['seller_name'];
                                    $buyer_name=$row['buyer_name'];
                                    $buy_amount=$row['buy_amount'];  

                                    $sql1 = "SELECT * FROM `product_sell` WHERE status='ordered' AND id='$product_id'";
                                    $result1 = $conn->query($sql1);

                                
                                    if ($result1->num_rows > 0) {
                                      // output data of each row
                                      while($row1 = $result1->fetch_assoc()) {
                                        $amount=$row1['amount'];  

                                        echo '   <tr>
                                        <td>'.$buyer_name.'</td>
                                        <td>'.getNumber($conn,$buyer_name).'</td>
                                        <td>'.$seller_name.'</td>
                                        <td>'.getNumber($conn,$seller_name).'</td>
                                        '.getProduct($conn, $product_id).'
                                        <td>'.$buy_amount.'/'.$amount.'</td>
                                        <td><form action="order.php" method="post">
                                        <input type="submit" class="btn btn-primary" value="done" name="'.$id.'">
                                        </form></td>
                                    </tr>';

                                      }
                                    
                                    }
                                    
                                   

                               

                                    }
                                  
                                  }
                                
                                ?>
                             
                        
                            </tbody>
                    </table>
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