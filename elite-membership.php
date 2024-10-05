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
    $type = 'elite'; // Type is now elite for this page
    $date = date('Y-m-d'); // Current date in YYYY-MM-DD format
    $bkash_transaction_id = $_POST['bkash_transaction_id']; // Get the transaction ID from form submission

    // First check if the user already has a membership (free/premium/elite)
    $check_sql = "SELECT type FROM membership WHERE reader_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $reader_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    
    if ($result->num_rows > 0) {
        // User has an existing membership, check the type
        $row = $result->fetch_assoc();
        if ($row['type'] === 'elite') {
            // User already has elite membership, show alert and redirect
            echo "<script>alert('You already have elite membership.'); window.location.href = 'borrow-list.php';</script>";
        } else {
            // Update membership to elite if it's currently free or premium
            $update_sql = "UPDATE membership SET type = ?, date = ? WHERE reader_id = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ssi", $type, $date, $reader_id);
            if ($update_stmt->execute()) {
                echo "<script>alert('Membership upgraded to Elite!'); window.location.href = 'borrow-list.php';</script>";
            } else {
                echo "<script>alert('Error: " . $conn->error . "');</script>";
            }
            $update_stmt->close();
        }
    } else {
        // No existing membership, insert new elite membership
        $sql = "INSERT INTO membership (reader_id, type, date) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $reader_id, $type, $date);

        if ($stmt->execute()) {
            echo "<script>alert('Elite Membership signup successful!'); window.location.href = 'borrow-list.php';</script>";
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
    <title>Elite Membership Payment</title>
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

        h3 {
            color: #333;
            font-size: 1.5rem;
            margin-bottom: 15px;
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

        input[type="text"], input[type="number"], input[type="submit"], select {
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        input[type="submit"] {
            background-color: #62ab00;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #4e8e00;
        }

        .bkash-info {
            background-color: #f9f9f9;
            border-left: 5px solid #62ab00;
            padding: 15px;
            font-size: 1.1rem;
            margin-bottom: 20px;
            color: #555;
        }

        .bkash-logo {
            display: block;
            margin: 0 auto;
            width: 150px;
            margin-bottom: 15px;
        }

        .payment-instructions {
            color: #777;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="membership-container">
        <h1>Elite Membership</h1>
        <h3>Rules & Regulations</h3>
        <ul>
            <li>Fees will be 5% of the book's original price.</li>
            <li>You can borrow books up to 2000 Taka.</li>
            <li>Books can be borrowed for a maximum of 45 days.</li>
            <li>If you don't return within time, the fees will increase by 2% every week.</li>
            <li>See your dashboard to track borrow time.</li>
            <li style="color: red">If you already have premium membership you will need to give just 1000 Taka.</li>
        </ul>

        <h3>Payment via bKash</h3>
        <img src="image/bkash-logo.png" alt="bKash Logo" class="bkash-logo">
        <p class="bkash-info">To complete your Elite Membership purchase, please follow the instructions below to make a payment through bKash:</p>
        
        <div class="payment-instructions">
            <p><strong>bKash Number:</strong> 01XXXXXXXXX</p>
            <p><strong>Reference:</strong> Elite Membership</p>
            <p><strong>Amount:</strong> 2000 Taka </p>
        </div>

        <form class="payment-form" method="POST">
            <input type="text" name="bkash_transaction_id" placeholder="bKash Transaction ID" required>
            <input type="submit" value="Complete Payment">
        </form>
    </div>
</body>
</html>
