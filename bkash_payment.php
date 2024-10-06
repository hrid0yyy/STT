<?php
session_start();
require 'backend/dbconnection.php';  // Include database connection
require 'bkash_api.php';      // Include your bKash API helper class

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cart_id = $_POST['cart_id'];  // Get the cart_id from the form
    $total_amount = $_POST['total_amount'];

    // Check if the cart_id exists in the cart table
    $cartCheckQuery = "SELECT cart_id FROM cart WHERE cart_id = ?";
    $cartCheckStmt = $conn->prepare($cartCheckQuery);
    $cartCheckStmt->bind_param('i', $cart_id);
    $cartCheckStmt->execute();
    $cartCheckStmt->store_result();

    if ($cartCheckStmt->num_rows == 0) {
        echo "Error: Cart ID does not exist in the cart table.";
        exit();
    }

    // Proceed with bKash payment
    $bkash = new BkashAPI();
    $payment_id = $bkash->createPayment($total_amount);

    if ($payment_id) {
        // Store the payment in the database with pending status
        $stmt = $conn->prepare("INSERT INTO payment (cart_id, payment_method, payment_status) VALUES (?, 'bKash', 'Pending')");
        $stmt->bind_param("i", $cart_id);
        $stmt->execute();

        // Store payment ID in session for callback handling
        $_SESSION['payment_id'] = $payment_id;

        // Redirect user to bKash payment URL
        header("Location: " . $bkash->getPaymentURL($payment_id));
        exit();
    } else {
        echo "Error initiating payment with bKash.";
    }
}
?>
