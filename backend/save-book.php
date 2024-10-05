<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to the database using PDO
$pdo = new PDO('mysql:host=localhost;dbname=stt_db', 'root', '');

// Get the raw POST data
$input = json_decode(file_get_contents('php://input'), true);

// Check if required data is present
if (isset($input['title'], $input['pdfUrl'], $input['shelfRow'], $input['userId'])) {
    $title = $input['title'];
    $pdfUrl = $input['pdfUrl'];
    $shelfRow = (int) $input['shelfRow'];
    $userId = (int) $input['userId'];

    // Log the received data (for debugging)
    file_put_contents('debug_log.txt', "Received data: Title - $title, PDF URL - $pdfUrl, Row - $shelfRow, User ID - $userId\n", FILE_APPEND);

    // Check if the table `bookshelf` exists, if not create it
    $createTableSQL = "
        CREATE TABLE IF NOT EXISTS bookshelf (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            book_title VARCHAR(255) NOT NULL,
            book_pdf_url TEXT NOT NULL,
            shelf_row INT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
    $pdo->exec($createTableSQL);

    // Insert the book into the bookshelf table
    $stmt = $pdo->prepare('INSERT INTO bookshelf (user_id, book_title, book_pdf_url, shelf_row) VALUES (?, ?, ?, ?)');
    if ($stmt->execute([$userId, $title, $pdfUrl, $shelfRow])) {
        echo json_encode(['success' => true, 'message' => 'Book added successfully.']);
    } else {
        // Log any error with the database query
        file_put_contents('debug_log.txt', "Error executing database query: " . implode(", ", $stmt->errorInfo()) . "\n", FILE_APPEND);
        echo json_encode(['success' => false, 'message' => 'Error adding book.']);
    }
} else {
    // Log missing data
    file_put_contents('debug_log.txt', "Missing data in request\n", FILE_APPEND);
    echo json_encode(['success' => false, 'message' => 'Invalid data received.']);
}
?>
