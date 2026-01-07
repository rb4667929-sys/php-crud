<?php include 'connect.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="view.css">
</head>
<body>
  
<button><a href="02_index.php">Home</a></button>
<div class="relative">
<div class="container"> 
<table class="gradient-table">
    <thead>
       <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Image</th>
          <th>Email</th>
          <th>Mobile</th>
          <th>Password</th>
          <th colspan="2" style="text-align: center">Actions</th>
       </tr>
   </thead>
   <tbody>
</html>
<?php 
$query="SELECT * FROM student";

$data=mysqli_query($con,$query);

$result=mysqli_num_rows($data);
if($result) {
    while($row=mysqli_fetch_array($data)){
       ?>
       
        <tbody>
        <tr>
        <td class="font-medium"><?php echo $row['id'] ?></td>
        <td><?php echo $row['fname'] ?></td>
        <td><?php echo $row['lname'] ?></td>
        <td><img src="images/<?php echo $row['image'] ?>" alt="Photo" height="80"></td>
        <td><?php echo $row['email'] ?></td>
        <td><?php echo $row['mobile'] ?></td>
        <td><?php echo str_repeat("*",strlen($row['password'])) ?></td>
        <td><a href="update.php?id=<?php echo $row['id']; ?>">Update</a></td>
        
        <td><a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
        </tbody>
       </tr>
    </div>
       <?php 
      }
   }
  else{
        ?>
            <td>No Record Found</td>
        <?php
    }
?>    
</table> 
</div>