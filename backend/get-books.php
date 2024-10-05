<?php
header('Content-Type: application/json');

// Connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=stt_db', 'root', '');

// Get the user ID from the session or request (use your actual session handling mechanism)
$userId = $_SESSION['user_id']; // Fetch user_id dynamically from session

// Fetch the user's books from the bookshelf table
$stmt = $pdo->prepare('SELECT * FROM bookshelf WHERE user_id = ?');
$stmt->execute([$userId]);

// Fetch all books and return them as JSON
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($books);
?>
