<?php 
include 'connect.php';
$id = $_GET['id'];

// Fetch existing data
$select = "SELECT * FROM student WHERE id='$id'";
$data = mysqli_query($con, $select);
$row = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <link rel="stylesheet" href="update.css">
</head>
<body>
<div class="container">
  <form action="" method="POST" enctype="multipart/form-data">
    <h1>Update Data</h1>
    
    <label for="fname">First Name:</label>
    <input type="text" name="fname" value="<?php echo $row['fname']; ?>" required><br><br>

    <label for="lname">Last Name:</label>
    <input type="text" name="lname" value="<?php echo $row['lname']; ?>" required><br><br>

    <label for="image">Image:</label>
    <input type="file" name="image"><br>
    <img src="images/<?php echo $row['image']; ?>" width="70px" alt="Student Image">
    <br><br> 

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>

    <label for="mobile">Mobile:</label>
    <input type="text" name="mobile" value="<?php echo $row['mobile']; ?>" required><br><br>

    <label for="password">Password:</label>
    <input type="password" name="password" value="<?php echo $row['password']; ?>" required><br><br>

    <input type="submit" name="update" value="Update" style="background-color: rgb(90, 127, 127);">
    <button><a href="view3.php" style="text-decoration:none; color:white;">Back</a></button>
  </form>
</div>

<?php
if (isset($_POST['update'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['mobile'];
    $pass = $_POST['password'];

    // Handle image upload
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];

    if ($image != "") {
        $destination = "images/" . $image;
        move_uploaded_file($tmp_name, $destination);
    } else {
        // If no new image selected, keep the old one
        $image = $row['image'];
    }

    // Update query
    $update = "UPDATE student SET fname='$fname', lname='$lname', image='$image', email='$email', mobile='$phone', password='$pass' WHERE id='$id'";
    $data = mysqli_query($con, $update);

    if ($data) {
        echo "<script>
                alert('Record updated successfully!');
                window.location.href = 'view3.php';
              </script>";
    } else {
        echo "<script>alert('Update failed, please try again.');</script>";
    }
}
?>
</body>
</html>
