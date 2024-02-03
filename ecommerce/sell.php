<?php
session_start();
$name=$_SESSION["name"];
include 'data/conn.php';

$imageErr="";
$image="";
$MAX_SIZE = 5 * 1024 * 1024; //  5MB

if (isset($_POST['submit'])) {
   
  
    if (isset($_FILES["image"])) {
      $target_dir = "./uploads/";
      
      $file_count = count($_FILES['image']['name']);

// validation
$errors = [];
for ($i = 0; $i < $file_count; $i++) {
      $target_file = $target_dir . basename($_FILES["image"]["name"][$i]);
      
    
    
    
    
    
      $file_name = $_FILES['image']['name'][$i];
      $file_size =$_FILES['image']['size'][$i];
      $file_tmp =$_FILES['image']['tmp_name'][$i];
      $file_type=$_FILES['image']['type'][$i];
      
      
      $image.=$file_name;
      if($i!=$file_count-1){
          $image.=",";
      }
      
      $file_ext=strtolower(strtok(strrev($file_name), "."));
      $file_ext=strrev($file_ext);
      
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPG, JPEG or PNG file.";
      }
      
      if($file_size > $MAX_SIZE){
         $errors[]='File size must be excately 5 MB';
      }
      if(move_uploaded_file($_FILES["image"]["tmp_name"][$i], $target_file)){
          
      }else{
          $errors[]='File not uploaded';
      }
      
}
      if(empty($errors)===true){
         if (isset($_POST['name']) && isset($_POST['type']) && isset($_FILES["image"]) && isset($_POST['price']) && isset($_POST['amount']) && isset($_POST['discription']))
         {

      $product_name=$_POST['name'];
      $type=$_POST['type'];
      //$image=$_FILES["image"]["name"];
      $amount=$_POST['amount'];
      $price=$_POST['price'];
      $discription=$_POST['discription'];

      if (isset($_POST['by'])) {
        $by=$_POST['by'];
        $sql="INSERT INTO `product_sell`(`seller_name`, `product_name`, `type`, `price`, `amount`,`by`,`img`, `description`, `status`)
       VALUES ('$name','$product_name','$type','$price','$amount','$by','$image','$discription','review')";
      }
     else{
      $sql="INSERT INTO `product_sell`(`seller_name`, `product_name`, `type`, `price`, `amount`,`by`,`img`, `description`, `status`)
       VALUES ('$name','$product_name','$type','$price','$amount','-','$image','$discription','review')";
     } 
  
      
        if ($conn->query($sql) === TRUE) {
            
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
  
  
    }
      
        }
        else{
        $x=count($errors);
       for($i=0;$i<$x;$i++){
           $imageErr.=$errors[$i];
           
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <title>Sell</title>
</head>
<body class="bg-light">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center" >
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap px-4 py-3 my-4 border" style="background-color: #00ACAB;">
                        
                        <div class="icon d-flex align-items-center">
                            <a href="dashboard.php" class="btn btn-outline-light" style="height: 60px; width:50px;"><i style="font-size: 2rem;" class="bi bi-arrow-bar-left"></i></a>
                        </div>

                        <h3 class="text-center mb-4 text-white">Sell</h3>
                        <form action="sell.php" method="post" class="login-form" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control rounded-left" placeholder="Product name" required>
                            </div>
                            <div class="form-group">
                                <select name="type" id="type" class="form-control rounded-left">
                                    <option value="">Choose...</option>
                                    <option value="crops">crops</option>
                                    <option value="Fertilizers">Fertilizers</option>
                                    <option value="seeds">seeds</option>
                                    <option value="Pestisieds">Pestisieds</option>
                                    <option value="other">Other chemicals</option>
                                    <option value="equpiments">Farming equpiments</option>
                                </select>
                            </div>
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                  <input type="number" name="amount" class="form-control rounded-left" placeholder="amount" required>
                                </div>  
                              </div>
                              <h6 class="pt-2">In</h6>
                              <div class="col">
                                <div class="form-group">
                                  <select name="by" id="type" class="form-control rounded-left">
                                    <option value="">Choose...</option>
                                    <option value="Cart">Cart</option>
                                    <option value="Madaberiya">Madaberiya</option>
                                </select>
                                </div>
                              </div>  
                            </div>
                            <div class="form-group">
                                <input type="number" name="price" class="form-control rounded-left" placeholder="price" required>
                            </div>
                            <div class="form-group">
                                <input type="file" id="image" name="image[]" multiple="multiple" accept="image/jpg, image/jpeg, image/png" class="form-control rounded-left">
                                <label for="name" style="font-size: 14px; color:red;"><?php echo $imageErr;?></label>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control rounded-left" name="discription" id="" rows="5" placeholder="Description"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="form-control btn btn-outline-light rounded submit px-3">Apply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $("#image").on("change", function() {
    if ($("#image")[0].files.length > 3) {
        alert("You can select only 3 images");
        $(this).val('');
    }
});
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>