<?php include 'conn.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="view.css">
</head>
<body>

<?php
// ------------------ INSERT DATA ------------------
if(isset($_POST['save'])) {
    $name    = $_POST['name'];
    $paydate = $_POST['date'];
    $rupees  = $_POST['rupees'];

    $query = "INSERT INTO user (name, date, rupees) VALUES ('$name', '$paydate', '$rupees')";
    $run = mysqli_query($con, $query);

    echo $run ? "<p style='color:green;'>Data Inserted!</p>" 
              : "<p style='color:red;'>Error: ".mysqli_error($con)."</p>";
}

// ------------------ UPDATE DATA ------------------
if(isset($_POST['update'])){
    $id      = $_POST['uid'];
    $name    = $_POST['name'];
    $paydate = $_POST['date'];
    $rupees  = $_POST['rupees'];

    $query = "UPDATE user SET name='$name', date='$paydate', rupees='$rupees' WHERE id='$id'";
    $run = mysqli_query($con, $query);

    echo $run ? "<p style='color:blue;'>Record Updated!</p>"
              : "<p style='color:red;'>Error: ".mysqli_error($con)."</p>";
}

// ------------------ DELETE DATA ------------------
if(isset($_GET['delete'])){
    $delID = $_GET['delete'];
    mysqli_query($con, "DELETE FROM user WHERE id='$delID'");
    echo "<p style='color:red;'>Record Deleted!</p>";
}

// ------------------ FETCH FOR EDIT ------------------
$editData = null;
if(isset($_GET['edit'])){
    $editID = $_GET['edit'];
    $editResult = mysqli_query($con, "SELECT * FROM user WHERE id='$editID'");
    $editData = mysqli_fetch_assoc($editResult);
}
?>

<!-- ------------------ MAIN FORM ------------------ -->
<form action="" method="POST">

    <input type="hidden" name="uid" value="<?php echo $editData['id'] ?? ''; ?>">

    <label>Name</label>
    <select name="name" required>
        <option value="">--Select--</option>
        <option value="meera"   <?php if(($editData['name'] ?? '') == 'meera') echo 'selected'; ?>>Meera</option>
        <option value="neeta"   <?php if(($editData['name'] ?? '') == 'neeta') echo 'selected'; ?>>Neeta</option>
        <option value="grishma" <?php if(($editData['name'] ?? '') == 'grishma') echo 'selected'; ?>>Grishma</option>
    </select><br><br>

    <label>Date</label>
    <input type="date" name="date"  value="<?php echo $editData['date'] ?? ''; ?>"><br><br>

    <label>Rupees</label>
    <input type="number" name="rupees" value="<?php echo $editData['rupees'] ?? ''; ?>"><br><br>

    <?php if($editData) { ?>
        <input type="submit" name="update" value="Update">
    <?php } else { ?>
        <input type="submit" name="save" value="Submit">
    <?php } ?>

    <input type="submit" name="search" value="Search">

</form>

<hr>

<?php
// ------------------ SEARCH FILTER ------------------
if(isset($_POST['search'])){
    $searchName = $_POST['name'];
    $query = "SELECT * FROM user WHERE name='$searchName'";
} else {
    $query = "SELECT * FROM user";
}

$data = mysqli_query($con, $query);
$result = mysqli_num_rows($data);
?>

<!-- ------------------ TABLE ------------------ -->
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Date</th>
        <th>Rupees</th>
        <th>Action</th>
    </tr>

    <?php
    $total = 0;
    if($result > 0){
        while($row = mysqli_fetch_assoc($data)){
            $total += $row['rupees'];
    ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['date']; ?></td>
            <td><?= $row['rupees']; ?></td>

            <td>
                <a href="?edit=<?= $row['id']; ?>">Edit</a> | 
                <a href="?delete=<?= $row['id']; ?>" onclick="return confirm('Delete this record?');">Delete</a>
            </td>
        </tr>
    <?php }} else { ?>
        <tr><td colspan="5" style="text-align:center;">No Records Found</td></tr>
    <?php } ?>
</table>

<?php if($result > 0){ ?>
    <h3>Total Rupees = ₹ <?= $total; ?></h3>
<?php } ?>

</body>
</html>