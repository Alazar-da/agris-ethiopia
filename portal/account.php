<?php
session_start();
$id=$_SESSION["name"];

if (!isset($id)) {
    header('location:login.php');
}
include 'data/conn.php';
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $nameErr =$lnameErr= $phoneErr = $emailErr = "";
  $cityErr = $passErr=$repassErr= "";

  $name =$lname = $phone = $emails = "";
  $city = $subCity = $pass= "";

  $fristName=$lastName=$email=$address=$phoneNumber="";
//echo $name;
$sql = "SELECT * FROM gh_customer_info WHERE id='$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $fristName=$row['name'];
        $lastName=$row['lname'];
        $email=$row['email'];
        $address=$row['address'];
        $phoneNumber=$row['phone_number'];

     
    
    }
}

if (isset($_POST['submit'])) {
  
  if (empty($_POST["name"])) {
    $nameErr = "*Name is required";
  } else {
    if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["name"])) {
        $nameErr = "*Only letters allowed";
      }
    else {
        $name = test_input($_POST["name"]);
        if($name!=$fristName){
               $sql = "UPDATE gh_customer_info SET name='$name' WHERE id='$id'";

                if ($conn->query($sql) === TRUE) {
                  header('location:account.php');
                } else {
                  echo "Error updating record: " . $conn->error;
                }
               
           }
    }  
    
  }
  if (empty($_POST["lname"])) {
    $lnameErr = "*Last Name is required";
  } else {
    if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["lname"])) {
        $lnameErr = "*Only letters allowed";
      }
    else {
        $lname = test_input($_POST["lname"]);
        if($lname!=$lastName){
               $sql = "UPDATE gh_customer_info SET lname='$lname' WHERE id='$id'";

                if ($conn->query($sql) === TRUE) {
                  header('location:account.php');
                } else {
                  echo "Error updating record: " . $conn->error;
                }
               
           }
    }  
    
  }
  if (isset($_POST['email'])) {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "*Invalid email format";
      }
      else {
        $emails = test_input($_POST["email"]);
        if($emails!=$email){
               $sql = "UPDATE gh_customer_info SET email='$emails' WHERE id='$id'";

                if ($conn->query($sql) === TRUE) {
                  header('location:account.php');
                } else {
                  echo "Error updating record: " . $conn->error;
                }
               
           }
      }
}


  if (empty($_POST["phone_number"])) {
    $phoneErr = "*phone number is required";
  }
  
  else {
      $phone1 = test_input($_POST["phone_number"]);
    
      $sql2 = "SELECT * FROM gh_customer_info WHERE phone_number='$phone1'";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
        if($phone1!=$phoneNumber){
            
        $phoneErr = "*this phone number is already taken";    
        }
        
        }
        else{
            $revphone=strrev($phone1);
            if (substr($revphone,8)=="90" && strlen($phone1)==10) {
      $phone = $phone1;
      if($phone!=$phoneNumber){
               $sql = "UPDATE gh_customer_info SET phone_number='$phone' WHERE id='$id'";

                if ($conn->query($sql) === TRUE) {
                  header('location:account.php');
                } else {
                  echo "Error updating record: " . $conn->error;
                }
               
           }
    }
    else{
      $phoneErr = "*Invalide phone number format";
    }
            
        }
      
      
    
    
  }


  if (empty($_POST["city"])) {
    $cityErr = "*city is required";
  } else {
      if(strpos($_POST["city"], ",") || strpos($_POST["city"], "/")){
           $city = test_input($_POST["city"]);
           if($address!=$city){
               $sql = "UPDATE gh_customer_info SET address='$city' WHERE id='$id'";

                if ($conn->query($sql) === TRUE) {
                  header('location:account.php');
                } else {
                  echo "Error updating record: " . $conn->error;
                }
               
           }
           
      }
      else{
         $cityErr = "*put comma(,) or slash(/) between City and sub-City"; 
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
    <link rel="stylesheet" href="style.css">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">





    <title>Account</title>
    <style >
      a{
        color: white;
      }
      a:hover{
        color: black;
        border-color:white ;
      }
      #pump{
        color: white;
        background-color: #007A7B;
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
          
         
            <a class="nav-link active" href="#">Dashboard</a> <span class="sr-only">(current)</span></a>
            <a class="nav-link" href="stastics.php">Stastics</a>
            <a class="nav-link" href="#">Wether</a>
            <a class="nav-link mr-auto" href="#">Messages</a>

           
        <a class="nav-link" href="account.php"><i style="font-size: 1.5rem;" class="bi bi-person-fill"></i></a>
        <a class="nav-link" href="logout.php"><i style="font-size: 1.5rem;" class="bi bi-box-arrow-left"></i></a>
          
        </div>
       
    </nav>



    <main class="mt-5 mb-5 pb-5">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center" >
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap  px-4 pt-3 pb-0 mb-5 my-3 border" style="background-color: #00ACAB;">
                        
                        <h3 class="text-center mb-4 text-white">Change Account Info.</h3>
                        <form action="account.php" class="login-form" method="post">
                            <div class="form-group d-flex">
                              <div class="p-2 d-flex flex-column">
                              <label for="name" style="font-size: 16px;">First name: </label>
                                <input type="text" class="form-control rounded-left" name="name" value="<?php echo $fristName;?>">
                                <label style="font-size: 14px; color:red;"><?php echo $nameErr;?></label>
                              </div>  
                              <div class="p-2 d-flex flex-column">
                                <label for="name" style="font-size: 16px;">Last name: </label>
                                <input type="text" class="form-control rounded-left" name="lname" value="<?php echo $lastName;?>">
                                <label style="font-size: 14px; color:red;"><?php echo $lnameErr;?></label>
                              </div>
                            </div>
                            <div class="form-group d-flex flex-column"> 
                                <label for="name" style="font-size: 16px;">Email: </label>
                                <input type="email" class="form-control rounded-left" name="email" value="<?php echo $email;?>">
                                <label  style="font-size: 14px; color:red;"><?php echo $emailErr;?></label>
                            </div>
                            <div class="form-group d-flex flex-column">
                                <label for="name" style="font-size: 16px;">Address: </label>
                                <input type="text" class="form-control rounded-left" name="city" value="<?php echo $address;?>">
                                <label  style="font-size: 14px; color:red;"><?php echo $cityErr;?></label>
                            </div>
                            <div class="form-group d-flex flex-column">
                            <label for="name" style="font-size: 16px;">Phone Number: </label>
                                <input type="number" class="form-control rounded-left" name="phone_number" value="<?php echo $phoneNumber;?>">
                                <label style="font-size: 14px; color:red;"><?php echo $phoneErr;?></label>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="form-control btn btn-outline-light rounded submit px-3" value="Change">
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="p-2 ml-auto">
                                    <a href="reset.php" class="font-weight-light btn btn-outline-light">Reset passowrd</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
        
    </main>



    <footer class="mt-5 w-100" style="background-color: #00ACAB; position: absolute;">
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
