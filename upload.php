<?php
include 'backend/dbconnection.php';
session_start();

if (isset($_POST['upload_book'])) {
    $user_id = $_SESSION['user_id']; // Get user ID from session
    $book_title = $_POST['book_title'];
    $writer = $_POST['writer'];
    $genre_id = $_POST['genre_id']; // Get the genre ID from the form

    // Handle PDF upload
    $pdf_name = $_FILES['pdf_file']['name'];
    $pdf_temp = $_FILES['pdf_file']['tmp_name'];
    $pdf_dir = 'uploads/pdfs/' . $pdf_name;

    // Handle Image upload
    $image_name = $_FILES['image_file']['name'];
    $image_temp = $_FILES['image_file']['tmp_name'];
    $image_dir = 'uploads/images/' . $image_name;

    // Move the uploaded files to respective directories
    if (move_uploaded_file($pdf_temp, $pdf_dir) && move_uploaded_file($image_temp, $image_dir)) {
        // Insert book details into the database
        $sql = "INSERT INTO bookshelf_pdfs (user_id, book_title, writer, genre_id, pdf_path, image_path) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ississ", $user_id, $book_title, $writer, $genre_id, $pdf_dir, $image_dir);

        if ($stmt->execute()) {
             // Redirect back to the bookshelf page after successful upload
             header("Location:book-shelf.php");
             exit(); // Make sure no further code is executed after redirection
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Failed to upload files.";
    }
}

$conn->close();
?>
