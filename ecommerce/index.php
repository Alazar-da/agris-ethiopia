<?php
include 'data/conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <title>E-Commerce</title>
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
    
    <nav class="navbar navbar-expand-lg" style="background-color: #007A7B;">
        <a class="navbar-brand mr-auto" href="#"><img src="Agris.png" style="height: 50px; width: 100px;" alt=""></a>
            <a class="nav-link btn btn-outline-light mr-1" href="login.php">login</a>
            <a class="nav-link btn btn-outline-light" href="register.php">register</a>
    </nav>


    <main class="mt-5">
      <div class="container jumbotron" style="background-color: #00ACAB;">
        <div class="row justify-content-center">
          <form action="index.php" class="form-inline" method="post">
            <div class="col"> 
            
                  <select name="type" id="type" class="form-control rounded-left">
                    <option value="">Choose...</option>
                    <option value="crops">crops</option>
                    <option value="Fertilizers">Fertilizers</option>
                    <option value="seeds">seeds</option>
                    <option value="Pestisieds">Pestisieds</option>
                    <option value="other">Other cemicals</option>
                    <option value="equpiments">Farming equpiments</option>
                  </select>
            </div>              
          
              <div class="col d-flex">
                <input type="text" name="search" id="search" placeholder="search" class="form-control rounded-left p-2">
                <button type="submit" name="submit" class="p-2 border-0 bg-white"><i class="bi bi-search"></i></button>
              </div>
          </form>
        </div>
      </div>

      <div class="container">
            <div class="row">
            <?php
            if (isset($_POST['submit'])) {
              
  

              if (isset($_POST['type'])) {
                $type=$_POST['type'];
                if (isset($_POST['search'])) {
                  //$search=$_POST['search'];
                  //$sql = "SELECT * FROM `product_sell` where (status='accept' or status='ordered') and amount!='0' and type='$type' and product_name='$search'";
                }
               //else{
                  $sql = "SELECT * FROM `product_sell` where (status='accept' or status='ordered') and amount!='0' and type='$type'";
               //}
              }
              else
              {
                //if (isset($_POST['search'])) {
                  //$search=$_POST['search'];
                //$sql = "SELECT * FROM `product_sell` where (status='accept' or status='ordered') and amount!='0' and product_name='$search'";
                //}
              }
            }
            else{
              $sql = "SELECT * FROM `product_sell` where (status='accept' or status='ordered') and amount!='0'";
            }


              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                  $product_name=$row['product_name'];
                  $type=$row['type'];
                  $image=$row["img"];
                  $price=$row['price'];
                  $discription=$row['description'];
                  $by=$row['by'];
                    //<img src="uploads/'.$image.'" style="max-height:250px" class="card-img-top" alt="...">
                  echo '
                  <div class="col mt-2 d-flex justify-content-center">
                    <div class="card" style="width: 18rem; background-color: #00ACAB;">
                    
                      
                      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner">
                      
                        ';
                        for($i=0;$i<count(explode(",",$image));$i++){
                        $images= explode(",",$image)[$i];
                        
                        echo '<div class="carousel-item
                        ';
                         if($i==0){
                                  echo'active';
                              }
                              echo'
                        ">
                              <img class="d-block w-100" src="uploads/'.$images.'" alt="First slide" style="max-height:250px">
                            </div>';
                        
                        
                         }
                        
                        echo '
                      </div>
                      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                      
                      
                      <div class="card-body">
                        <h5 class="card-title">Product Name '.$product_name.'</h5>
                        <p class="card-text">Price '. $price.'/'.$by.' Birr </p>
                        <button onclick="alerted()" class="btn btn-outline-light">order</button>
                      </div>
                    </div>
                  </div>';
                }
              } else {
                echo '
                <div class="col-12">
                  <p class="text-center">No result found</p>
                </div>
                ';
              }
            ?>
     
            </div>
        </div>



    </main>

<script>

 function alerted(){

  window.alert("Create an account or login");

  }
</script>

    <footer class="mt-5" style="background-color: #00ACAB;">
        <div class="container-fluid text-white">
            <div class="row justify-content-between pt-3">
                <div class="col-md-4 col-10 text-center">
                    <h5>Important links</h5>
                    <ul style="list-style-type: none;">
                        <li><a href="aboutus.html">About us</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="aboutus.html">Terms and Condition</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-10 text-center text-white">
                    <h5>Catagories</h5>
                    <ul style="list-style-type: none;">
                        <li><a href="#">Crops</a></li>
                        <li><a href="#">Fertilizers</a></li>
                        <li><a href="#">Seeds</a></li>
                        <li><a href="#">Pestisieds</a></li>
                        <li><a href="#">Other cemicals</a></li>
                        <li><a href="#">Farming</a></li>
                    </ul>
                </div>
            </div>
            <div class="row justify-content-center mt-3 text-white">
                <div class="col-9 text-center text-white">
                    <a class="nav-link d-inline" href="#"><i style="font-size: 1.5rem;" class="bi bi-facebook"></i></a>
                    <a class="nav-link d-inline" href="#"><i style="font-size: 1.5rem;" class="bi bi-instagram"></i></a>
                    <a class="nav-link d-inline" href="#"><i style="font-size: 1.5rem;" class="bi bi-envelope-at-fill"></i></a>
                    <a class="nav-link d-inline" href="#"><i style="font-size: 1.5rem;" class="bi bi-twitter"></i></a>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
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