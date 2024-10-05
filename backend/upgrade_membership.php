<?php
include 'dbconnection.php';

$user_id = $_POST['user_id'];
$membership_type = $_POST['membership_type'];

// Update the user's membership in the database
$query = $pdo->prepare("UPDATE memberships SET membership_type = :membership_type WHERE user_id = :user_id");
$query->bindParam(':membership_type', $membership_type);
$query->bindParam(':user_id', $user_id);
$query->execute();

header("Location: membership_success.php");
?>
