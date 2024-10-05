<?php
// Include the database connection file
include 'dbconnection.php';

function totalnotification($reader_id){
    global $conn;

    $sql = "SELECT *
    from exchange_notification
    join exchange_req on exchange_notification.req_id = exchange_req.req_id
    join exchange_books as eb_requestor on eb_requestor.exchange_id = exchange_req.requestor_exchange_id
    join books as requestor_books on eb_requestor.book_id = requestor_books.book_id
    join readers as requestor on eb_requestor.reader_id = requestor.reader_auto_id
    join exchange_books as eb_requestee on eb_requestee.exchange_id = exchange_req.requestee_exchange_id
    join readers as requestee on eb_requestee.reader_id = requestee.reader_auto_id
    join books as requestee_books on eb_requestee.book_id = requestee_books.book_id
    where (requestee.reader_auto_id = ? and requestee_status = 'unseen') OR
    	  (requestor.reader_auto_id = ? and requestor_status = 'unseen')";

            // Prepare the statement
            if ($stmt = $conn->prepare($sql)) {
            // Bind the reader_id parameter
            $stmt->bind_param("ii",$reader_id, $reader_id);

            // Execute the query
            $stmt->execute();

            // Get the result set
            $result = $stmt->get_result();

            // Get the number of rows
            $row_count = $result->num_rows;

            // Close the statement
            $stmt->close();

            // Return the number of unseen notifications
            return $row_count;
            } else {
            // Handle query preparation error
            return 0; // Return 0 if there is an error
            }

}


function getUnseenExchangeRequests($reader_id) {
    global $conn;
    // Prepare the SQL query with placeholders for dynamic values
    $sql = "SELECT request_status,Accepter.first_name, requester_books.title AS requester_book_title, 
    available_books.title AS available_book_title, Accepter.phone_number, Accepter.email
FROM exchange_requests 
JOIN available_books_for_exchange 
 ON exchange_requests.available_book_id = available_books_for_exchange.available_book_id 
JOIN readers as requester
 ON exchange_requests.requester_reader_id = requester.reader_auto_id
JOIN readers as Accepter
on available_books_for_exchange.reader_id = Accepter.reader_auto_id
JOIN books AS requester_books 
 ON exchange_requests.requester_book_id = requester_books.book_id
JOIN books AS available_books
 ON available_books_for_exchange.book_id = available_books.book_id
WHERE exchange_requests.notification_status = 'unseen' and exchange_requests.request_status != 'pending' and exchange_requests.requester_reader_id = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the reader_id parameter
        $stmt->bind_param("i",$reader_id);

        // Execute the query
        $stmt->execute();

        // Get the result set
        $result = $stmt->get_result();

        // Check if there are rows
        if ($result->num_rows > 0) {
            // Fetch all results into an associative array
            $rows = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // No rows found, return an empty array
            $rows = [];
        }

        // Close the statement
        $stmt->close();

        // Return the result
        return $rows;

    } else {
        // Handle query preparation error
        return [];
    }
}
function getExchangeRequests($reader_id) {
    global $conn;
    // Prepare the SQL query with placeholders for dynamic values
    $sql = "SELECT notification_id,requestor.first_name as requestor_name, requestor.reader_auto_id as requestor_id,requestor.phone_number as requestor_phone_number,requestor_books.title as requestor_book,requestor_status,
    requestee.first_name as requestee_name, requestee.reader_auto_id as requestee_id,
    requestee_books.title as requestee_book,requestee_status,status,request_date,response_date
    from exchange_notification
    join exchange_req on exchange_notification.req_id = exchange_req.req_id
    join exchange_books as eb_requestor on eb_requestor.exchange_id = exchange_req.requestor_exchange_id
    join books as requestor_books on eb_requestor.book_id = requestor_books.book_id
    join readers as requestor on eb_requestor.reader_id = requestor.reader_auto_id
    join exchange_books as eb_requestee on eb_requestee.exchange_id = exchange_req.requestee_exchange_id
    join readers as requestee on eb_requestee.reader_id = requestee.reader_auto_id
    join books as requestee_books on eb_requestee.book_id = requestee_books.book_id
    where requestee.reader_auto_id = ? 
    ORDER by request_date DESC";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the reader_id parameter
        $stmt->bind_param("i",$reader_id);

        // Execute the query
        $stmt->execute();

        // Get the result set
        $result = $stmt->get_result();

        // Check if there are rows
        if ($result->num_rows > 0) {
            // Fetch all results into an associative array
            $rows = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // No rows found, return an empty array
            $rows = [];
        }

        // Close the statement
        $stmt->close();

        // Return the result
        return $rows;

    } else {
        // Handle query preparation error
        return [];
    }
}


function getResponse($reader_id) {
    global $conn;
    // Prepare the SQL query with placeholders for dynamic values
    $sql = "SELECT notification_id,requestor.first_name as requestor_name, requestor.reader_auto_id as requestor_id,requestor.phone_number as requestor_phone_number,requestor_books.title as requestor_book,requestor_status,
    requestee.first_name as requestee_name, requestee.reader_auto_id as requestee_id,
    requestee_books.title as requestee_book,requestee_status,requestee.phone_number as requestee_phone_number,status,request_date,response_date
    from exchange_notification
    join exchange_req on exchange_notification.req_id = exchange_req.req_id
    join exchange_books as eb_requestor on eb_requestor.exchange_id = exchange_req.requestor_exchange_id
    join books as requestor_books on eb_requestor.book_id = requestor_books.book_id
    join readers as requestor on eb_requestor.reader_id = requestor.reader_auto_id
    join exchange_books as eb_requestee on eb_requestee.exchange_id = exchange_req.requestee_exchange_id
    join readers as requestee on eb_requestee.reader_id = requestee.reader_auto_id
    join books as requestee_books on eb_requestee.book_id = requestee_books.book_id
    where requestor.reader_auto_id = ? and status != 'pending' 
    ORDER by request_date DESC";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the reader_id parameter
        $stmt->bind_param("i",$reader_id);

        // Execute the query
        $stmt->execute();

        // Get the result set
        $result = $stmt->get_result();

        // Check if there are rows
        if ($result->num_rows > 0) {
            // Fetch all results into an associative array
            $rows = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // No rows found, return an empty array
            $rows = [];
        }

        // Close the statement
        $stmt->close();

        // Return the result
        return $rows;

    } else {
        // Handle query preparation error
        return [];
    }
}



function updateNotificationStatusToSeen($notification_id,$person) {
    global $conn;
    // Prepare the SQL query to update the notification_status to 'unseen'
    if ($person=="Requestee"){
    $sql = "UPDATE exchange_notification SET requestee_status = 'seen' WHERE notification_id = ?";
    }
    if ($person=="Requestor"){
        $sql = "UPDATE exchange_notification SET requestor_status = 'seen' WHERE notification_id = ?";
        }
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Bind the request ID to the statement
    $stmt->bind_param("i", $notification_id);
    
    // Execute the query
    if ($stmt->execute()) {
        return "Notification status updated to unseen.";
    } else {
        return "Error updating notification status: " . $stmt->error;
    }
    
    // Close the statement
    $stmt->close();
}



?>
