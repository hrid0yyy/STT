<?php
// Start session to access session variables
session_start();

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection
    $servername = "localhost";  
    $username = "root"; 
    $password = ""; 
    $dbname = "stt_db";       

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the reader_id from session and set membership details
    $reader_id = $_SESSION['user_id'];
    $type = 'free';
    $date = date('Y-m-d'); // Current date in YYYY-MM-DD format

    // Check if the user already has the free membership
    $check_sql = "SELECT * FROM membership WHERE reader_id = ? AND type = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("is", $reader_id, $type);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        // User already has the free membership, redirect to borrow-list.php
        echo "<script>alert('You already have this free membership. Redirecting to borrow list...'); window.location.href = 'borrow-list.php';</script>";
    } else {
        // Insert new membership if user doesn't have it already
        $sql = "INSERT INTO membership (reader_id, type, date) VALUES (?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $reader_id, $type, $date);

        if ($stmt->execute()) {
            echo "<script>alert('Membership signup successful!'); window.location.href = 'borrow-list.php';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }

        $stmt->close();
    }

    $check_stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Membership Rules and Signup</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
            color: #333;
        }

        .membership-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        h1 {
            color: #62ab00;
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        ul {
            list-style-type: disc;
            padding-left: 20px;
            margin-bottom: 20px;
        }

        .payment-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="submit"] {
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            background-color: #62ab00;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #4e8e00;
        }

        .no-payment-info {
            color: #555;
            font-size: 1rem;
            margin-bottom: 20px;
            text-align: center;
        }

    </style>
</head>
<body>
    <div class="membership-container">
        <h1>Free Membership</h1>
        <h3>Rules & Regulations</h3>
        <ul>
            <li>Fees will be 20% of the book's original price.</li>
            <li>You can borrow only 1 book at a time.</li>
            <li>Books will be borrowed for a maximum of 14 days.</li>
        </ul>

        <h3>No Payment Required</h3>
        <p class="no-payment-info">Since this is a free membership, no payment is required. Please complete the signup form below.</p>

        <form class="payment-form" method="POST">
            <input type="submit" value="Get Membership">
        </form>
    </div>
</body>
</html>
