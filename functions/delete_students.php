<?php
include_once("../dbConnection/connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $user_id = intval($_POST['id']);

    $delete_query = "DELETE FROM users WHERE id = $user_id";

    if (mysqli_query($dbc, $delete_query)) {
        echo "<script>
                alert('Student deleted successfully.');
                window.location.href = '../index.php'; // Redirect after successful deletion
              </script>";
    } else {
        echo "<script>
                alert('Error deleting student: " . mysqli_error($dbc) . "');
                window.location.href = '../index.php'; // Redirect after error
              </script>";
    }
} else {
    echo "Invalid request.";
}
?>
