<?php
include 'connect.php';

$id = $_GET['id'];
?>

<script>
    // Ask for confirmation before sending the delete request
    let confirmDelete = confirm("Are you sure you want to delete this record?");
    if (confirmDelete) {
        // If user clicks OK, proceed with deletion
        window.location.href = "delete2.php?confirmed=1&id=<?php echo $id; ?>";
    } else {
        // If user clicks Cancel, go back
        window.location.href = "view3.php";
    }
</script>

<?php
// Handle confirmed delete
if (isset($_GET['confirmed']) && $_GET['confirmed'] == 1) {
    $id = $_GET['id'];
    $query = "DELETE FROM student WHERE id='$id'";
    $data = mysqli_query($con, $query);

    if ($data) {
        echo "<script>alert('Record deleted successfully'); window.location.href='view3.php';</script>";
    } else {
        echo "<script>alert('Please try again'); window.location.href='view3.php';</script>";
    }
}
?>
