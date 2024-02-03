<?php
session_start();
include 'data/conn.php';
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  $phone_number = $pass = $nameErr = $passErr =$accErr =$passhashed= "";
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
        
        
    if (empty($_POST["pass"])) {
        $passErr = "*Password is required";
    }
        else {
            $pass = test_input($_POST["pass"]);
            $passhashed=md5($pass);
        }
}
if (!empty($phone_number) && !empty($pass)){
    $sql = "SELECT * FROM gh_customer_info WHERE phone_number='$phone_number'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if($passhashed==$row['password']){
                $_SESSION["name"] = $row['id'];
                if ($row['level']=="1") {
                    header("location:admin/index.php");
                }
                else{
                header("location:index.php");
            }
            }
else {
    $passErr="*Incorrect Password";
}
        
        }
    }
    else {
        $accErr="*There is no record Create an Account";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <title>Login</title>
   
</head>
<body class="bg-light">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center" >
                <div class="col-md-7 col-lg-5 mt-5">
                    <div class="login-wrap p-4 p-md-5 mt-5 border" style="background-color: #00ACAB;">
                        
                        <div class="icon d-flex align-items-center">
                            <a href="../index.html" class="btn btn-outline-light" style="height: 60px; width:50px;"><i style="font-size: 2rem;" class="bi bi-arrow-bar-left"></i></a>
                            <div class="mx-auto pr-5">
                                <i style="font-size: 2rem;" class="bi bi-person-circle text-white"></i>
                            </div>
                        </div>
                        <h3 class="text-center mb-4 text-white">Login to Portal</h3>
                        <form action="login.php" method="post" class="login-form">
                            <div class="form-group d-flex flex-column">
                                <input type="number" name="phone_number" class="form-control rounded-left" placeholder="09xxxxxxxx" required>
                                <label for="name" style="font-size: 14px; color:red;"><?php echo $nameErr;?></label>
                            </div>
                            <div class="form-group d-flex flex-column" style="position: relative;">
                                <input type="password" name="pass" class="form-control rounded-left" placeholder="Password" autocomplete="current-password" required="" id="id_password" style=" width: 100%;box-sizing: border-box;">
                                <i class="far fa-eye" id="togglePassword" style="   position: absolute;
  top: 25%;
  right: 4%;
  cursor: pointer;
  color: lightgray;"></i>
  
                                <label for="name" style="font-size: 14px; color:red;"><?php echo $passErr;?></label>
                                <label for="name" style="font-size: 14px; color:red;"><?php echo $accErr;?></label>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="form-control btn btn-outline-light rounded submit px-3">Login</button>
                            </div>
                            <div class="form-group d-flex">
                                <div class="pl-0 pr-2 py-2 d-inline">
                                    <a href="register.php" class="font-weight-light btn btn-outline-light">Create an account</a>
                                    </label>
                                </div>
                                <div class="px-0 py-2 ml-auto d-inline">
                                    <a href="number_check.php" class="font-weight-light btn btn-outline-light">Forgot Password</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script>
   const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#id_password');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
    </script>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>