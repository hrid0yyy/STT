<?php
include 'dbconnection.php';
if(isset($_POST['add_item'])){
    
  $book_name = $_POST['book_name'];
  $available_copies = $_POST['available_copies'];

  additem($book_name,$available_copies);

}

function additem($book_name,$available_copies){
    global $conn;
    // First, search for the book_id from the books table using a partial match (LIKE)
    $sql = "SELECT book_id, title FROM books WHERE title LIKE ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Use wildcard search for partial matches
    $book_name = '%' . $book_name . '%';
    
    // Bind the book_name parameter
    $stmt->bind_param("s", $book_name);
    
    // Execute the query
    $stmt->execute();
    
    // Store the result
    $result = $stmt->get_result();
    
    // Check if any matching books were found
    if ($result->num_rows > 0) {
        // Fetch the first matching book
        $row = $result->fetch_assoc();
        $book_id = $row['book_id'];
        $shop_owner_id = $_SESSION['user_id'];
        
        // Check if the book is already in the borrow_bookavailability table
        $check_sql = "SELECT available_copies FROM borrow_bookavailability WHERE book_id = ? AND shop_owner_id = ?";
        
        // Prepare the check statement
        $check_stmt = $conn->prepare($check_sql);
        
        // Bind the parameters (book_id, shop_owner_id)
        $check_stmt->bind_param("ii", $book_id, $shop_owner_id);
        
        // Execute the check statement
        $check_stmt->execute();
        
        // Get the result
        $check_result = $check_stmt->get_result();
        
        if ($check_result->num_rows > 0) {
            // Book already exists in the table, update available_copies by incrementing it
            $existing_row = $check_result->fetch_assoc();
            $existing_copies = $existing_row['available_copies'];
            
            // Increment the available copies
            $new_copies = $existing_copies + $available_copies;
            
            // Prepare the update query
            $update_sql = "UPDATE borrow_bookavailability SET available_copies = ? WHERE book_id = ? AND shop_owner_id = ?";
            $update_stmt = $conn->prepare($update_sql);
            
            // Bind the parameters (new_copies, book_id, shop_owner_id)
            $update_stmt->bind_param("iii", $new_copies, $book_id, $shop_owner_id);
            
            // Execute the update statement
            $update_stmt->execute();
            
        } else {
            // Book is not in the table, insert a new row
            $insert_sql = "INSERT INTO borrow_bookavailability (book_id, shop_owner_id, available_copies)
                           VALUES (?, ?, ?)";
            
            // Prepare the insert statement
            $insert_stmt = $conn->prepare($insert_sql);
            
            // Bind the parameters (book_id, shop_owner_id, available_copies)
            $insert_stmt->bind_param("iii", $book_id, $shop_owner_id, $available_copies);
            
            // Execute the insert statement
            $insert_stmt->execute();
        }
    }
    


}
if(isset($_POST['return'])){
       $borrowing_id = $_POST['return'];
       mark_book_as_returned($borrowing_id);
}


function mark_book_as_returned($borrowing_id) {
    global $conn;

    // SQL query to update the borrowing table
    $sql = "UPDATE borrowing 
            SET is_returned = 1, return_date = NOW() 
            WHERE borrowing_id = ?";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Bind the borrowing_id parameter
    $stmt->bind_param("i", $borrowing_id);

    // Execute the query
    if ($stmt->execute()) {
        return true;  // Successfully updated
    } else {
        return false;  // Failed to update
    }
}


function get_borrowed_books($shop_owner_id) {
    global $conn;

    // SQL query to fetch borrowed books that are not returned
    $sql = "SELECT readers.reader_id, title, borrow_date, borrowing_id 
            FROM borrowing 
            JOIN readers ON borrowing.reader_id = readers.reader_auto_id
            JOIN books ON borrowing.book_id = books.book_id 
            WHERE shop_owner_id = ? AND is_returned = 0";
    
    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);
    
    // Bind the parameter (shop_owner_id)
    $stmt->bind_param("i", $shop_owner_id);
    
    // Execute the query
    $stmt->execute();
    
    // Get the result set
    $result = $stmt->get_result();
    
    // Fetch all rows as an associative array
    $borrowed_books = $result->fetch_all(MYSQLI_ASSOC);
    
    // Return the result set
    return $borrowed_books;
}


?>