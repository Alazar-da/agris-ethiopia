<?php
session_start();
include 'otp.php';
include 'data/conn.php';
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $phone_number = $nameErr =$accErr= "";
  if (isset($_POST['submit'])) {
  
   if (empty($_POST["phone_number"])) {
      $nameErr = "*Phone number is required";
    } else {
        $phone1 = test_input($_POST["phone_number"]);
        $revphone=strrev($phone1);
        if (substr($revphone,8)=="90" && strlen($phone1)==10) {
          $phone_number = $phone1;
        }
        else{
          $nameErr = "*Invalide phone number format";
        }
        } 
    
}
if (!empty($phone_number)){
    $sql = "SELECT * FROM info WHERE phone_number='$phone_number'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $phone = $phone_number;
        $to =$phone;
        $message = rand(1000,9999);
        $template_id = 'otp';  
        $send = sendSMS($to, $message, $template_id);
        echo $send;
        
        $_SESSION['message']="$message";
        $_SESSION['number']=$phone;
  
  echo '  
    <form method="post" action="number_check.php"  id="form">
            <input name="val" type="hidden" id="reason" />
       </form>
    
    <script>
        while(!opt){
            var opt = prompt("We have send you a verification code to your phone number please enter the number");
        }
    document.getElementById("reason").value = opt;
    document.getElementById("form").submit();
    </script>';
        
        
        
        
    }
    else {
        $accErr="*There is no record Create an Account";
    }
    
    

}


if(isset($_POST['val'])){
        
 $message=$_SESSION['message'];
 $phone=$_SESSION['number'];
  
  if($_POST['val']==$message){
      $_SESSION['phone']=$phone;
      header('location:forgot.php');
      
      
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
    <title>Phone Number input</title>
</head>
<body class="bg-light">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center" >
                <div class="col-md-7 col-lg-5 mt-5">
                    <div class="login-wrap p-4 p-md-5 mt-5 border" style="background-color: #00ACAB;">
                        
                        <div class="icon d-flex align-items-center">
                            <a href="login.php" class="btn btn-outline-light" style="height: 60px; width:50px;"><i style="font-size: 2rem;" class="bi bi-arrow-bar-left"></i></a>
                        </div>
                        <h3 class="text-center mb-4 text-white">Enter Your Phone Number</h3>
                        <form action="number_check.php" method="post" class="login-form">
                            <div class="form-group d-flex flex-column">
                                <input type="number" name="phone_number" class="form-control rounded-left" placeholder="09xxxxxxxx" required>
                                <label for="name" style="font-size: 14px; color:red;"><?php echo $nameErr;?></label>
                                <label for="name" style="font-size: 14px; color:red;"><?php echo $accErr;?></label>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="form-control btn btn-outline-light rounded submit px-3">Send</button>
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