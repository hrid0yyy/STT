<?php
   include 'dbconnection.php';
  
function markBookAsReturned($conn, $borrowing_id) {

      $sql = "UPDATE Borrowing SET is_returned = TRUE, return_date = NOW() WHERE borrowing_id = ?";
      $stmt = $conn->prepare($sql);
      
      $stmt->bindParam(':borrowing_id', $borrowing_id, PDO::PARAM_INT);

      $stmt->close();
   }

   function borrowBook($reader_id, $book_id, $shop_owner_id) {
    global $conn;

    // Start transaction
    $conn->begin_transaction();

    try {
        // Check the user's current membership
        $sql = "SELECT type FROM membership WHERE reader_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $reader_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $membership_type = null;
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $membership_type = $row['type']; // Get the membership type (free, premium, elite)
        } else {
            // If no membership, prompt user to get a membership first
            echo "<script>alert('You need to get a membership first.'); window.location.href = 'borrow-list.php';</script>";
            return;
        }

        // If the user has a free membership, check the number of books in possession
        if ($membership_type == 'free') {
            // Check how many books the user already has borrowed and not returned
            $sql = "SELECT COUNT(*) as total_books FROM Borrowing WHERE reader_id = ? AND is_returned = FALSE";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $reader_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $total_books_in_possession = $row['total_books'] ?? 0;

            // If the user already has 1 book, they cannot borrow another one under free membership
            if ($total_books_in_possession >= 1) {
                echo "<script>alert('You can only borrow one book at a time under the free membership. Please return a book first.');</script>";
                return;
            }
        } else {
            // For premium and elite memberships, check the total value of books the user already has in possession
            $sql = "
            SELECT SUM(bso.price) as total_borrowed_price
            FROM Borrowing b
            JOIN book_shopowners bso ON b.book_id = bso.book_id AND b.shop_owner_id = bso.shop_owner_id
            WHERE b.reader_id = ? AND b.is_returned = FALSE;
            ";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $reader_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $total_borrowed_price = $row['total_borrowed_price'] ?? 0;

            // Get the price of the current book
            $sql = "SELECT price FROM book_shopowners WHERE book_id = ? AND shop_owner_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $book_id, $shop_owner_id);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if the book exists and fetch the price
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $book_price = $row['price'];
            } else {
                // Book not found in the shop, throw an error
                throw new Exception("Book not found for the given shop owner.");
            }

            // Add the current book's price to the total borrowed price
            $total_borrowed_price += $book_price;

            // Check membership limits for premium and elite members
                    if ($membership_type == 'premium' && $total_borrowed_price > 1000) {
                        echo "<script>
                                alert('You can only borrow books with a total price of up to 1000 Taka under the premium membership.');
                                window.location.href = 'borrow-books-reader.php';
                            </script>";
                        return;
                    } elseif ($membership_type == 'elite' && $total_borrowed_price > 2000) {
                        echo "<script>
                                alert('You can only borrow books with a total price of up to 2000 Taka under the elite membership.');
                                window.location.href = 'borrow-books-reader.php';
                            </script>";
                        return;
                    }
        }

        // Verify the shop_owner_id exists in the shopowners table
        $sql = "SELECT shop_owner_id FROM shopowners WHERE shop_owner_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $shop_owner_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Invalid shop owner ID.");
        }

        

        $sql = "INSERT INTO Borrowing (reader_id, book_id, shop_owner_id, borrow_date) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("iii", $reader_id, $book_id, $shop_owner_id);

        if (!$stmt->execute()) {
            throw new Exception("Error inserting record: " . $stmt->error);
        }

        // Update book availability
        $sql = "UPDATE borrow_bookavailability SET available_copies = available_copies - 1 WHERE book_id = ? AND shop_owner_id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ii", $book_id, $shop_owner_id);

        if (!$stmt->execute()) {
            throw new Exception("Error updating record: " . $stmt->error);
        }

        // Commit transaction
        $conn->commit();
       // After successful borrowing, display the Bootstrap alert
       header("Location: borrow-books-reader.php?status=success");
            exit;

       

    } catch (Exception $e) {
        // Rollback on error
        $conn->rollback();
        echo "Transaction failed: " . $e->getMessage();
    }

    // Close statement
    $stmt->close();
}


  function search($searchTerm){
    
                                        global $conn;    

        $sql = "SELECT bookcover,title,available_copies,shop_name,description,city,address,phone_number,email,
        shopowners.shop_owner_id,books.book_id FROM `borrow_bookavailability` join books ON borrow_bookavailability.book_id = books.book_id
                                                join shopowners on borrow_bookavailability.shop_owner_id = shopowners.shop_owner_id
                                                WHERE title LIKE '%$searchTerm%' and available_copies>0";

        $result = $conn->query($sql);
    
  
        if ($result->num_rows > 0) {

            $books = [];
            while($row = $result->fetch_assoc()) {
                $books[] = $row;
            }
            return $books;
        } else {
            return null; 
        }
  }
// Function to insert borrowing information
function borrow($reader_id,$shop_owner_id, $book_id) {
    global $conn;


    $sql = "SELECT title, shop_name, borrow_date 
    FROM borrowing
    JOIN shopowners ON shopowners.shop_owner_id = borrowing.shop_owner_id
    JOIN books ON borrowing.book_id = books.book_id
    WHERE reader_id = $reader_id AND is_returned = 0";

// Execute the query
$result = $conn->query($sql);

if ($result->num_rows > 0 ) {
    $row = $result->fetch_assoc();
// If the query returns rows, display a message

echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
<strong>Hiyaa!</strong> You already took <span style='color:red;'>" . htmlspecialchars($row['title']) . "</span> from 
<span style='color:red;'>" . htmlspecialchars($row['shop_name']) . "</span> on 
<span style='color:red;'>" . htmlspecialchars($row['borrow_date']) . "</span> which you still didn't return.
<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
</button>
</div>";

return;
}




    // Prepare the SQL insert statement
    $sql = "INSERT INTO borrowing (reader_id, shop_owner_id, book_id) 
            VALUES (?, ?, ?)";

    // Prepare the statement to avoid SQL injection
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters (s - string, i - integer, d - double, b - blob)
        $stmt->bind_param("iii", $reader_id, $shop_owner_id, $book_id);
        
        // Execute the statement
        if ($stmt->execute()) {
          
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
if (isset($_POST['borrow_book'])) {
    $shop_owner_id = $_POST['shop_owner_id'];
    $book_id = $_POST['book_id'];
    $reader_id = $_POST['reader_id'];
    
    // Call the borrowBook function to borrow the book
    borrowBook($reader_id, $book_id, $shop_owner_id);

  
}



  
?>