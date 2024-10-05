<?php
include 'dbconnection.php';     

function account_details($user_id) {
    global $conn;
    // Query the database
    $sql = "SELECT * FROM shopowners WHERE shop_owner_id = $user_id";
    $result = $conn->query($sql);

    // Check if any result was returned
    if ($result->num_rows > 0) {
        // Fetch the result row as an associative array
        return mysqli_fetch_assoc($result);
    } else {
        return null;  // Return null if no rows are found
    }
}


?>