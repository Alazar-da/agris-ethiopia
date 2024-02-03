<?php
session_start();
$name=$_SESSION["name"];
if (!isset($name)) {
    header('location:login.php');
}
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
<body style="margin: 0; padding: 0; box-sizing: border-box;">
    
<nav class="navbar navbar-expand-lg navbar-light" style="background-color:#007A7B;">
    <a class="navbar-brand" href="#"><img src="../ecommerce/Agris.png" style="height: 50px; width: 100px;" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          
         
            <a class="nav-link active" href="index.php">Dashboard</a> <span class="sr-only">(current)</span></a>
            <a class="nav-link" href="stastics.php">Stastics</a>
            <a class="nav-link" href="#">Wether</a>
            <a class="nav-link mr-auto" href="#">Messages</a>

           
        <a class="nav-link" href="account.html"><i style="font-size: 1.5rem;" class="bi bi-person-fill"></i></a>
        <a class="nav-link" href="logout.php"><i style="font-size: 1.5rem;" class="bi bi-box-arrow-left"></i></a>
          
        </div>
       
    </nav>



    <main class="mt-5">
      <div class="container" style="background-color: #00ACAB; height: 300px;">
        <div class="row">
            <div class="col-3 px-0">
                <form action="#" method="post">
                    <input type="submit" value="Temprature" class="font-weight-light btn btn-lg btn-outline-light w-100" name="temp">
                </form>
            </div>
            <div class="col-3 px-0">
                <form action="#" method="post">
                    <input type="submit" value="Humidity" class="font-weight-light btn btn-lg btn-outline-light w-100" name="humd">
                </form>
            </div>
            <div class="col-3 px-0">
                <form action="#" method="post">
                    <input type="submit" value="Pump" class="font-weight-light btn btn-lg btn-outline-light w-100" name="pump">
                </form>
            </div>
            <div class="col-3 px-0">
                <form action="#" method="post">
                    <input type="submit" value="Fan" class="font-weight-light btn btn-lg btn-outline-light w-100" name="fan">
                </form>
            </div>
        </div>
        <div class="row bg-white d-flex justify-content-center mx-1 mb-5" style="height: fit-content;">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore ratione nam consectetur quos minus provident ipsa error accusamus nisi, delectus, eos, fuga magni veniam saepe molestias natus! Non, officia deleniti!</p>
            
        </div>
      </div>
    </main>



    <footer class="mt-5 w-100" style="background-color: #00ACAB; position: absolute; bottom: 0;">
        <div class="container-fluid text-white">
            <div class="row justify-content-center pt-3">
                <div class="col-md-4 col-10 text-center">
                    <h5>Important links</h5>
                    <ul style="list-style-type: none;">
                        <li><a href="aboutus.html">About us</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="aboutus.html">Terms and Condition</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-10 text-center">
                    <h5>Catagories</h5>
                    <ul style="list-style-type: none;">
                        <li><a class="nav-link active" href="#">Dashboard</a></li>
                        <li><a class="nav-link" href="stastics.php">Stastics</a></li>
                        <li><a class="nav-link" href="#">Wether</a></li>
                        <li><a class="nav-link" href="#">Messages</a></li>
                    </ul>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-9 text-center">
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