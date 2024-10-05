<?php
include 'backend/dbconnection.php';
session_start();

if (isset($_POST['book_id'])) {
    $book_id = $_POST['book_id'];
    $user_id = $_SESSION['user_id']; 

    // Fetch the book details from the database
    $sql = "SELECT book_title, pdf_path, progress FROM bookshelf_pdfs WHERE book_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $book_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();

    if ($book) {
        // Display the PDF and reading progress
        echo '<h2>Reading: ' . htmlspecialchars($book['book_title']) . '</h2>';
        echo '<iframe src="' . htmlspecialchars($book['pdf_path']) . '" width="100%" height="600"></iframe>';
        echo '<form action="update_progress.php" method="POST">';
        echo '<input type="hidden" name="book_id" value="' . $book_id . '">';
        echo '<label for="progress">Update your progress:</label>';
        echo '<input type="number" name="progress" value="' . $book['progress'] . '" min="0" max="100">';
        echo '<button type="submit">Update Progress</button>';
        echo '</form>';
    } else {
        echo 'Book not found or you do not have access to this book.';
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'No book selected to read.';
}
?>
