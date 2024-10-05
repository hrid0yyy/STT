<?php
include 'backend/dbconnection.php';
session_start();

if (isset($_POST['book_id'], $_POST['progress'])) {
    $book_id = $_POST['book_id'];
    $user_id = $_SESSION['user_id'];
    $progress = intval($_POST['progress']);

    // Update the progress in the database
    $sql = "UPDATE bookshelf_pdfs SET progress = ? WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $new_progress, $id, $user_id);
    $stmt->execute();

    if ($stmt->execute()) {
        // Redirect back to the bookshelf or reading page
        header("Location: book-shelf.php");
        exit();
    } else {
        echo 'Error updating progress: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'Invalid request.';
}
?>
