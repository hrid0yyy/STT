<?php
  include 'dbconnection.php';
 
  if (isset($_REQUEST['add_book'])) {
    // Get data from POST request
    $book_name = $_POST['book_name'];
    $reader_id = $_SESSION['user_id'];
    $preferred_genre = $_POST['preferred_genre'];
    $condition_image = $_POST['condition_image'];

    // Call the insertAvailableBookForExchange function
    // Call the insertAvailableBookForExchange function and store the result in a variable
$message = insertAvailableBookForExchange($book_name, $reader_id, $preferred_genre, $condition_image, $conn);

// Echo the message (error or success)
echo "<div class='alert alert-info'>$message</div>";

// Add JavaScript to redirect after a few seconds
echo "<script>
        setTimeout(function() {
            window.location.href = '" . $_SERVER['PHP_SELF'] . "';
        }, 3000); // Redirect after 3 seconds
      </script>";

} else {

}

if (isset($_POST['accept'])) {
    $req_id = $_POST['accept'];

    // Update request status to 'accepted' and set the current time for response_time
    $sql = "UPDATE exchange_req SET status = 'accepted', response_date = NOW() WHERE req_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    // If prepare() fails, show the error message
    die("Error preparing the SQL statement: " . $conn->error);
}

// Bind the parameter
$stmt->bind_param("i", $req_id);

// Execute the query
if ($stmt->execute()) {
    echo "Exchange request accepted.";
} else {
    // If execute() fails, show the error message
    echo "Error executing the query: " . $stmt->error;
}
$stmt->close();
// Redirect to avoid form resubmission
header("Location: " . $_SERVER['PHP_SELF']);
exit();

}

if (isset($_POST['decline'])) {
    $req_id = $_POST['decline'];

    // Update request status to 'declined' and set the current time for response_time
    $sql = "UPDATE exchange_req SET status = 'declined', response_date = NOW() WHERE req_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $req_id);

    if ($stmt->execute()) {
        echo "Exchange request declined.";
    } else {
        echo "Error executing the query: " . $stmt->error;
    }

    $stmt->close();
    // Redirect to avoid form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

function myExchangeBooks() {
    global $conn;
    $reader_id = $_SESSION['user_id'];

$sql = "SELECT * FROM `available_books_for_exchange` join books on available_books_for_exchange.book_id = books.book_id WHERE reader_id = $reader_id";
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

function AvailableForExchange($searchTerm){
    global $conn;
    $reader_id = $_SESSION['user_id'];

$sql = "SELECT title,bookcover,books.book_id as book_id,first_name,country,preferred_genre,condition_image,reader_auto_id,available_book_id FROM `available_books_for_exchange` join books on available_books_for_exchange.book_id = books.book_id join readers on available_books_for_exchange.reader_id = readers.reader_auto_id
WHERE title LIKE '%$searchTerm%' and readers.reader_auto_id != $reader_id and is_available = 'yes'";
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
if(isset($_POST['exchange_btn'])){
    if (empty($_SESSION['user_id'])) {
        // Show login first message but don't exit, allow the page to refresh and stay
        echo "<script>alert('Please login first to exchange books');</script>";
    } else {
     $requestor_exchange_id = $_POST['requestor_exchange_id'];
     $requestee_exchange_id = $_POST['requestee_exchange_id'];




// SQL query to insert data into exchange_requests table with properly quoted string values
try {
    $sql = "INSERT INTO exchange_req (requestor_exchange_id, requestee_exchange_id) 
            VALUES ('$requestor_exchange_id', '$requestee_exchange_id')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Exchange request successfully submitted.";
        header("Location: index.php");
    } else {
        // Show the custom error message if query fails
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Error!</strong> You already requested this book. Please wait for the owner's response!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
    }
} catch (mysqli_sql_exception $e) {
    // This will catch the duplicate entry error or any other SQL error
    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Error!</strong> You already requested this book. Please wait for the owner's response!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
}
    
    }

}





function getAvailableBooksForExchangeByUser($reader_id) {
    global $conn;
    // Prepare the SQL query to select books available for exchange by a specific user
    $sql = "SELECT title,preferred_genre,bookcover,exchange_id
    FROM exchange_books
    JOIN books on exchange_books.book_id = books.book_id
    LEFT JOIN exchange_req AS eq1 ON exchange_books.exchange_id = eq1.requestor_exchange_id
    LEFT JOIN exchange_req AS eq2 ON exchange_books.exchange_id = eq2.requestee_exchange_id
    WHERE (eq1.status != 'accepted' OR eq1.status IS NULL) 
    AND (eq2.status != 'accepted' OR eq2.status IS NULL)
    AND exchange_books.reader_id = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Bind the reader_id parameter
    $stmt->bind_param("i", $reader_id);
    
    // Execute the query
    $stmt->execute();
    
    // Get the result set
    $result = $stmt->get_result();
    
    // Check if any books are found
    if ($result->num_rows > 0) {
        // Fetch all rows and return as an associative array
        $books = $result->fetch_all(MYSQLI_ASSOC);
        return $books;
    } else {
        return []; // Return an empty array if no books are found
    }
    
    // Close the statement
    $stmt->close();
}


function exchangeReq($reader_id, $conn)
{
    // Prepare the SQL query to select books available for exchange by a specific user
    $sql = "
    SELECT req_id,b2.bookcover,b1.title as available_title,b2.title as requester_title ,eb2.condition_image as book_condition,b2.genre,email,phone_number from exchange_req
join exchange_books as eb1  on eb1.exchange_id = exchange_req.requestee_exchange_id
join exchange_books as eb2  on eb2.exchange_id = exchange_req.requestor_exchange_id
join books as b1 on eb1.book_id = b1.book_id
join books as b2 on eb2.book_id = b2.book_id
join readers on eb2.reader_id = readers.reader_auto_id
where eb1.reader_id = ? and status = 'pending'
    ";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind both reader_id parameters (for both subqueries)
    $stmt->bind_param("i", $reader_id);  // Bind reader_id twice

    // Execute the query
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Check if any books are found
    if ($result->num_rows > 0) {
        // Fetch all rows and return as an associative array
        $req = $result->fetch_all(MYSQLI_ASSOC);
        return $req;
    } else {
        return []; // Return an empty array if no books are found
    }

    // Close the statement
    $stmt->close();
}


function insertAvailableBookForExchange($book_name, $reader_id, $preferred_genre, $condition_image, $conn) {

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
        // Fetch the first match
        $row = $result->fetch_assoc();
        $book_id = $row['book_id'];
        $matched_book_title = $row['title']; 
        
        // Now, insert into available_books_for_exchange table using the retrieved book_id
        $insert_sql = "INSERT INTO exchange_books (book_id, reader_id, listed_date, preferred_genre, condition_image)
                       VALUES (?, ?, CURRENT_TIMESTAMP, ?, ?)";
        
        // Prepare the insert statement
        $insert_stmt = $conn->prepare($insert_sql);
        
        // Bind the parameters (book_id, reader_id, preferred_genre, condition_image)
        $insert_stmt->bind_param("iiss", $book_id, $reader_id, $preferred_genre, $condition_image);
        
        // Execute the insert statement
        if ($insert_stmt->execute()) {
            // Success message displayed using HTML
            echo "<div class='alert alert-success'>Book '{$matched_book_title}' listed for exchange successfully.</div>";
        } else {
            // Error message displayed using HTML
            echo "<div class='alert alert-danger'>Error inserting book into available_books_for_exchange: " . $insert_stmt->error . "</div>";
        }
        $insert_stmt->close();
    } else {
        // If no matching books were found, display an error message in HTML
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Error!</strong> This book is still not available in Shelf to tales.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
    }
    
    // Close the statements
    
    $stmt->close();
}

function updatebookavailability($availability, $requester_reader_id,$requester_book_id){

    global $conn;

    $sql = "UPDATE available_books_for_exchange SET is_available = ? WHERE reader_id = ? and book_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    // If prepare() fails, show the error message
    die("Error preparing the SQL statement: " . $conn->error);
}

// Bind the parameter
$stmt->bind_param("sii",$availability,  $requester_reader_id,$requester_book_id);

// Execute the query
if ($stmt->execute()) {
   
} else {
    // If execute() fails, show the error message
    echo "Error executing the query: " . $stmt->error;
}
    // Delete the book from available_books_for_exchange
  
    $stmt->close();
}

function isRequestAccepted($requester_reader_id,$requester_book_id) {
    global $conn;

    // Prepare the SQL query to check for a row with 'accepted' status
    $sql = "SELECT COUNT(*) AS count FROM exchange_requests WHERE requester_reader_id = ? AND requester_book_id = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        // If prepare() fails, show the error message
        die("Error preparing the SQL statement: " . $conn->error);
    }
    
    // Bind the parameter
    $stmt->bind_param("ii", $requester_reader_id,$requester_book_id);
    
    // Execute the query
    if ($stmt->execute()) {
        // Get the result
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    
        // Close the statement
        $stmt->close();
    
        // Check if any row exists with the status 'accepted'
        if ($row['count'] > 0) {
            updatebookavailability('no', $requester_reader_id,$requester_book_id);
          //  echo "Book availability updated to 'no'. Exchange request is accepted.";
        } else {
            updatebookavailability('yes', $requester_reader_id,$requester_book_id);
         //   echo "Book availability updated to 'yes'. No accepted exchange request.";
        }
    } else {
        // If execute() fails, show the error message
        echo "Error executing the query: " . $stmt->error;
    }
    
}


?>
