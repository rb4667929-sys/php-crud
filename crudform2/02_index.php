<?php include 'connect.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div>

<?php
if(isset($_POST['save_btn'])) {

    $fname=$_POST['fname'];
    $lname=$_POST['lname'];  
    $image=$_FILES['image']['name'];
    $tmp_name=$_FILES['image']['tmp_name'];
    $destination="images/".$image;
    move_uploaded_file($tmp_name, $destination);
    $email=$_POST['email'];
    $phone=$_POST['mobile'];
    $pass=$_POST['password'];

   

    $query = "INSERT INTO `student` (`fname`, `lname`,`image`, `email`, `mobile`, `password`) 
              VALUES ('$fname', '$lname','$image', '$email', '$phone', '$pass')";

    $data = mysqli_query($con, $query);
    

 if($data) {
    ?>
    <script type="text/javascript">
        alert("Data Saved successfully");
    </script>
    <?php
 }else{
    ?>
    <script>
        alert("Please try again");
    </script>
    <?php
  }
}

?>    
</div>

<div class="container">
    <form action="" method="POST" enctype="multipart/form-data">
        
        <h1 class="heading">Registration Form</h1>

         <label for="fname">First Name</label>
         <input type="text" name="fname" placeholder="Enter name.." required><br><br>

            
         <label for="lname">Last Name</label>
         <input type="text" name="lname" placeholder="Enter name.." required><br><br>
            
         <label for="">Image</label>
         <input type="file" name="image"><br><br> 

         <label for="email">Email</label>
         <input type="email" name="email" placeholder="Enter email.." required><br><br>

         <label for="mobile">Mobile</label>
         <input type="text" name="mobile" placeholder="Enter mobile.." required><br><br>

         <label for="password">Password</label>
         <input type="password" name="password" placeholder="Enter password.." required><br><br>

         <input type="submit" name="save_btn"> 
                 
         <button style="margin-top: 20px;";><a href="view3.php">View</a></button>  
        
    </form>  
 </div>     
</body>
</html>