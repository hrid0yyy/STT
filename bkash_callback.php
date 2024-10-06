<?php
session_start();
require 'dbconnection.php';  // Include database connection
require 'bkash_api.php';      // Include your bKash API helper class

// Get the payment ID from session or callback response
$payment_id = $_SESSION['payment_id'] ?? $_POST['paymentID'];

if ($payment_id) {
    // Initialize bKash API to verify and execute the payment
    $bkash = new BkashAPI();
    $payment_status = $bkash->executePayment($payment_id);

    if ($payment_status['status'] === 'Completed') {
        // Update payment record in the database
        $transaction_id = $payment_status['transactionID'];
        $stmt = $conn->prepare("UPDATE payment SET payment_status = 'Paid', transaction_id = ? WHERE payment_id = ?");
        $stmt->bind_param("si", $transaction_id, $payment_id);
        $stmt->execute();

        // Redirect to success page
        header("Location: payment_success.php");
        exit();
    } else {
        echo "Payment failed. Please try again.";
    }
}
?>
