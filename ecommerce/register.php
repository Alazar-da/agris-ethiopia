<?php
include 'data/conn.php';
include 'otp.php';
session_start();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $nameErr =$lnameErr= $phoneErr = $emailErr = "";
  $cityErr = $passErr=$repassErr= "";

  $name =$lname = $phone = $email = "";
  $city = $pass= "";


if (isset($_POST['submit'])) {
  
  if (empty($_POST["name"])) {
    $nameErr = "*Name is required";
  } else {
    if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["name"])) {
        $nameErr = "*Only letters allowed";
      }
    else {
        $name = test_input($_POST["name"]);
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
    }  
    
  }
  if (isset($_POST['email'])) {
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "*Invalid email format";
      }
      else {
        $email = test_input($_POST["email"]);
      }
}


  if (empty($_POST["phone_number"])) {
    $phoneErr = "*phone number is required";
  }
  
  else {
      $phone1 = test_input($_POST["phone_number"]);
    
      $sql2 = "SELECT * FROM info WHERE phone_number='$phone1'";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
        $phoneErr = "*this phone number is already taken";
        }
        else{
            $revphone=strrev($phone1);
            if (substr($revphone,8)=="90" && strlen($phone1)==10) {
      $phone = $phone1;
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
      }
      else{
         $cityErr = "*put comma(,) or slash(/) between City and sub-City"; 
      }
   
  }

  

 

  if (empty($_POST["pass"])) {
    $passErr = "*passowrd is required";
  } else {
   
    

  if (empty($_POST["repass"])) {
    $repassErr = "*retyed password is required";
  } else {

  if ($_POST["repass"]!==$_POST["pass"]) {
    $repassErr = "*the password does not match";
  }
  else {
    $pass1 = test_input($_POST["pass"]);
    if (strlen($pass1)>=8) {
      $pass = $pass1;
    }
    else {
      $passErr = "*password must be 8 character";
      
    }
    

    
  }
}
  }

  if (!empty($name) && !empty($lname) && !empty($phone) && !empty($city) && !empty($pass)) {
    
    $passhash=md5($pass);
    
    
    
       $to =$phone;
        $message = rand(1000,9999);
        $template_id = 'otp';  
        $send = sendSMS($to, $message, $template_id);
        echo $send;
        
        echo '
        <form method="post" action="register.php"  id="form">
            <input name="val" type="hidden" id="reason" />
       </form>
        <script>
    while(!opt){
      var opt = prompt("We have send you a verification code to your phone number please enter the number");
    }
    document.getElementById("reason").value = opt;
    document.getElementById("form").submit();
</script>';
    
    if (!empty($email))
  {
    $sql="INSERT INTO `info`(`name`,`lname`,`email`, `address`, `Phone_number`, `password`, `level`) VALUES ('$name','$lname','$email','$city','$phone','$passhash','2')";
  
  }
  else {
    $sql="INSERT INTO `info`(`name`,`lname`, `email`, `address`, `Phone_number`, `password`, `level`) VALUES ('$name','$lname','','$city','$phone','$passhash','2')";
  }
  $_SESSION['sql']=$sql;
  $_SESSION['$message']="$message";

  }




}




if(isset($_POST['val'])){
        $sql=$_SESSION['sql'];
  $message=$_SESSION['$message'];
  
  if($_POST['val']==$message){
      
      if ($conn->multi_query($sql) === TRUE) {
          
      echo '<script>
        alert("Your account has been created successfully");
      
      </script>';
      //include 'logout.php';
      
      //sleep(3);
      //header('location:login.php');
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
  }
  else{
      echo '<script>
      alert("Your verification code incorrect register again");
      </script>';
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
    <title>Register</title>
</head>
<body class="bg-light">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center" >
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap  px-4 pt-3 pb-0 mb-5 my-3 border" style="background-color: #00ACAB;">
                        
                        <div class="icon d-flex align-items-center">
                            <a href="index.php" class="btn btn-outline-light" style="height: 60px; width:50px;"><i style="font-size: 2rem;" class="bi bi-arrow-bar-left"></i></a>
                            <div class="mx-auto pr-5">
                                <i style="font-size: 2rem;" class="bi bi-person-circle text-white"></i>
                            </div>
                        </div>
                        <h3 class="text-center mb-4 text-white">Register</h3>
                        <form action="register.php" class="login-form" method="post">
                            <div class="form-group d-flex ">
                              <div class="p-2 d-flex flex-column">
                                <input type="text" class="form-control rounded-left" name="name" placeholder="First name" required>
                                <label for="name" style="font-size: 14px; color:red;"><?php echo $nameErr;?></label>
                              </div>  
                              <div class="p-2 d-flex flex-column">
                                  <input type="text" class="form-control rounded-left" name="lname" placeholder="Last name" required>
                                  <label for="name" style="font-size: 14px; color:red;"><?php echo $lnameErr;?></label>
                              </div>
                            </div>
                            <div class="form-group d-flex flex-column"> 
                                <input type="email" class="form-control rounded-left" name="email" placeholder="email">
                                <label for="name" style="font-size: 14px; color:red;"><?php echo $emailErr;?></label>
                            </div>
                            <div class="form-group d-flex flex-column">
                                    <input type="text" class="form-control rounded-left" name="city" placeholder="City, sub-City" required>
                                    <label for="name" style="font-size: 14px; color:red;"><?php echo $cityErr;?></label>
                            </div>
                            <div class="form-group d-flex flex-column">
                                <input type="number" class="form-control rounded-left" name="phone_number" placeholder="09xxxxxxxx">
                                <label for="name" style="font-size: 14px; color:red;"><?php echo $phoneErr;?></label>
                            </div>
                            <div class="form-group d-flex flex-column">
                                <input type="password" class="form-control rounded-left" name="pass" placeholder="Password" required>
                                <label for="name" style="font-size: 14px; color:red;"><?php echo $passErr;?></label>
                            </div>
                            <div class="form-group d-flex flex-column">
                                <input type="password" class="form-control rounded-left" name="repass" placeholder="Re-type Password" required>
                                <label for="name" style="font-size: 14px; color:red;"><?php echo $repassErr;?></label>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="form-control btn btn-outline-light rounded submit px-3" value="Register">
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="p-2 ml-auto">
                                    <a href="login.php" class="font-weight-light btn btn-outline-light">Log in</a>
                                </div>
                            </div>
                        </form>
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