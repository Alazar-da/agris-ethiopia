<?php
include 'data/conn.php';
session_start();
  $sql=$_SESSION['sql'];
  $message=$_SESSION['$message'];
  
  if($_POST['val']==$message){
      
      if ($conn->multi_query($sql) === TRUE) {
      echo '<script>
      function myFunction() {
        alert("Your account has been created successfully");
      }
      </script>';
      
      
      header('location:login.php');
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
  }
  else{
      
      $err="Your verification code incorrect";
  }

    
    
    ?>
    
    