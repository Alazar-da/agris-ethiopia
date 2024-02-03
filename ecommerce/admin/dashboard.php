<?php
session_start();
$name=$_SESSION["name"];
include '../data/conn.php';

$sql1 = "SELECT * FROM product_sell where status='review'";
$result = $conn->query($sql1);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $id=$row['id'];
if (isset($_POST['submit']) && isset($_POST[$id])) {
$status=$_POST[$id];
$sql2 = "UPDATE product_sell SET status='$status' WHERE id='$id'";

if ($conn->query($sql2) === TRUE) {
  header('location:dashboard.php');
} else {
  echo "Error updating record: " . $conn->error;
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
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <title>Dashboard</title>
    <style >
      a{
        color: white;
      }
      a:hover{
        color: black;
        border-color:white ;
      }
    </style>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color:#007A7B;">
    <a class="navbar-brand" href="#"><img src="../Agris.png" style="height: 50px; width: 100px;" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          
         
            <a class="nav-link active" href="#">Dashboard</a> <span class="sr-only">(current)</span></a>
            <a class="nav-link" href="sell.php">sell</a>
            <a class="nav-link" href="order.php">order</a>
            <a class="nav-link mr-auto" href="#">Messages</a>

           
        <a class="nav-link" href="account.html"><i style="font-size: 1.5rem;" class="bi bi-person-fill"></i></a>
        <a class="nav-link" href="../logout.php"><i style="font-size: 1.5rem;" class="bi bi-box-arrow-left"></i></a>
          
        </div>
       
    </nav>



    <main class="mt-5 mb-5">
    
        <div class="container">
            <div class="row justify-content-center">
              <?php
              
                $sql = "SELECT * FROM product_sell where status='review'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                    $id=$row['id'];
                    $product_name=$row['product_name'];
                    $type=$row['type'];
                    $image=$row["img"];
                    $price=$row['price'];
                    $discription=$row['description'];

                    echo '
                    <div class="col mt-2">
                    <div class="card" style="width: 18rem;">
                        <img src="../uploads/'.$image.'" style="max-heigh:250px" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">'.$product_name.'</h5>
                          <p class="card-text">'.$price.' Birr </p>
                          <form action="dashboard.php" method="post">
                            <div class="form-check-inline">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="'.$id.'" value="Accept">Accept
                            </label>
                            </div>
                            <div class="form-check-inline">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="'.$id.'" value="Reject">Reject
                            </label>
                            </div>
                            <div class="form-group">
                              <button type="submit" name="submit" class="form-control btn btn-primary rounded submit px-3">Apply</button>
                            </div>
                          </form> 
                        </div>
                      </div>
                </div>';
                  }
                } else {
                  echo "<div class='text-center'>0 results</div>";
                }
              ?>
                
            </div>
        </div>



    </main>



    <footer class="mt-5" style="background-color: #00ACAB;">
        <div class="container-fluid">    
            <div class="row justify-content-center pt-3 pb-3">
                <div class="col-8">
                    <p class="text-center"><i class="bi bi-c-circle"></i> 2023 Agris.et E-Commerce</p>
                </div>
            </div>
        </div>
    </footer>  
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>