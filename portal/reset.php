<?php

session_start();
$name=$_SESSION["name"];
if (!isset($name)) {
    header('location:login.php');
}
include 'data/conn.php';


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  
  $passErr=$repassErr=$bpassErr= "";
  $pass=$oldpass= "";



if (isset($_POST['submit'])) {
    
    
    
    
        $sql = "SELECT * FROM gh_customer_info WHERE id='$name'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $oldpass=$row['password'];
        
        if (empty($_POST["bpass"])) {
                $bpassErr = "*Old passowrd is required";
              } else {
                  $inputoldpass=md5($_POST["bpass"]);
                  if($inputoldpass==$oldpass){
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
                      
                  }
                  else{
                      $bpassErr = "*Old passowrd was not correct";
                      
                  }
                  
              }
        
    }
    
}    
    else{
        
        echo "no result";
    }
    
    

  
             
  
  if (!empty($pass)) {
    
    $passhash=md5($pass);
    
  $sql = "UPDATE gh_customer_info SET password='$passhash' WHERE id='$name'";

if ($conn->query($sql) === TRUE) {
  echo '<script>
        alert("You have changed your password");
      
      </script>';
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();
  
 

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
    <title>Reset Password</title>
</head>
<body class="bg-light">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center" >
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap  px-4 pt-3 pb-0 mb-5 my-3 border" style="background-color: #00ACAB;">
                        
                        <div class="icon d-flex align-items-center">
                            <a href="index.php" class="btn btn-outline-light" style="height: 60px; width:50px;"><i style="font-size: 2rem;" class="bi bi-arrow-bar-left"></i></a>
                        </div>
                        <h3 class="text-center mb-4 text-white">Reset password</h3>
                        <form action="reset.php" class="login-form" method="post">
                           <div class="form-group d-flex flex-column" style="position: relative;">
                                <input type="password" class="form-control rounded-left" name="bpass" placeholder="Old password" required id="id_password" style=" width: 100%;box-sizing: border-box;">
                                <i class="far fa-eye" id="togglePassword" style="   position: absolute;
  top: 25%;
  right: 4%;
  cursor: pointer;
  color: lightgray;"></i>
                                <label for="name" style="font-size: 14px; color:red;"><?php echo $bpassErr;?></label>
                            </div>
                            <div class="form-group d-flex flex-column" style="position: relative;">
                                <input type="password" class="form-control rounded-left" name="pass" placeholder="New Password" required id="id_password1" style=" width: 100%;box-sizing: border-box;">
                                <i class="far fa-eye" id="togglePassword1" style="   position: absolute;
  top: 25%;
  right: 4%;
  cursor: pointer;
  color: lightgray;"></i>
                                <label for="name" style="font-size: 14px; color:red;"><?php echo $passErr;?></label>
                            </div>
                            <div class="form-group d-flex flex-column" style="position: relative;">
                                <input type="password" class="form-control rounded-left" name="repass" placeholder="Confrim Password" required id="id_password2" style=" width: 100%;box-sizing: border-box;">
                                <i class="far fa-eye" id="togglePassword2" style="   position: absolute;
  top: 25%;
  right: 4%;
  cursor: pointer;
  color: lightgray;"></i>
                                <label for="name" style="font-size: 14px; color:red;"><?php echo $repassErr;?></label>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="form-control btn btn-outline-light rounded submit px-3" value="Change">
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
  
  const togglePassword1 = document.querySelector('#togglePassword1');
  const password1 = document.querySelector('#id_password1');
  
    const togglePassword2 = document.querySelector('#togglePassword2');
  const password2 = document.querySelector('#id_password2');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});

togglePassword1.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
    password1.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});

  togglePassword2.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
    password2.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>