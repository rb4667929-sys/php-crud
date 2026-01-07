<?php include 'conn.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch Same Name Data</title>
    <link rel="stylesheet" href="fill.css">
</head>
<body>

<div class="container">

    <h2>Add Data</h2>

    <!-- Form for inserting data -->
    <form action="" method="POST">

        <label for="name">Search by Name</label>
        <select name="name" required>
            <option value="">--Select--</option>
            <option value="meera">Meera</option>
            <option value="neeta">Neeta</option>
            <option value="grishma">Grishma</option>
        </select><br><br>

        <label>Date</label>
        <input type="date" name="date" required><br><br>

        <label>Rupees</label>
        <input type="number" name="rupees" required><br><br>

        <input type="submit" name="save" value="Submit">
        <button><a href="view.php">View</a></button>

    </form>


    <hr>

    <?php
    // Insert data
    if(isset($_POST['save'])) {

        $name    = $_POST['name'];
        $paydate = $_POST['date'];
        $rupees  = $_POST['rupees'];

        $query = "INSERT INTO user (name, `date`, rupees) VALUES ('$name', '$paydate', '$rupees')";
        $data  = mysqli_query($con, $query);

        if($data){
            echo "<p style='color:green;'>Data Saved Successfully!</p>";
        } else {
            echo "<p style='color:red;'>Error: " . mysqli_error($con) . "</p>";
        }

         header("Location: fill.php?success=1");
         exit();


    }
    ?>

    <!-- Display table -->
    <table>
        <tr>
           <th>Id</th>
           <th>Name</th>
           <th>Date</th>
           <th>Rupees</th>
        </tr>

        <?php
        $query = "SELECT * FROM user ORDER BY id DESC";
        $data = mysqli_query($con, $query);

        if(mysqli_num_rows($data) > 0){
            while($row = mysqli_fetch_assoc($data)){
        ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['rupees']; ?></td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='4' style='text-align:center;'>No records found</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
