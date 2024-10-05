<?php
     include 'dbconnection.php';


     if (isset($_REQUEST['update_reader_profile'])) {



        // Retrieve form data
        $reader_id = $_SESSION['user_id'];
        $first_name = !empty($_POST['first_name']) ? $_POST['first_name'] : NULL;
        $last_name = !empty($_POST['last_name']) ? $_POST['last_name'] : NULL;
        $profile_pic = !empty($_POST['profile_pic']) ? $_POST['profile_pic'] : NULL;
        $phone_number = !empty($_POST['phone_number']) ? $_POST['phone_number'] : NULL;
        $date_of_birth = !empty($_POST['date_of_birth']) ? $_POST['date_of_birth'] : NULL;
        $email = !empty($_POST['email']) ? $_POST['email'] : NULL;
        $country = !empty($_POST['country']) ? $_POST['country'] : NULL;
    
        // Prepare SQL query
        $sql = "UPDATE readers
                SET 
                    first_name = ?,
                    last_name = ?,
                    phone_number = ?,
                    date_of_birth = ?,
                    email = ?,
                    country = ?,
                    profile_pic = ?
                WHERE reader_auto_id = ?";
    
        // Prepare statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters to the prepared statement
            $stmt->bind_param("sssssssi", $first_name, $last_name, $phone_number, $date_of_birth, $email, $country,$profile_pic, $reader_id);
            
            // Execute the statement
            if ($stmt->execute()) {
               echo $profile_pic;
            } else {
                
            }
    
            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing the statement: " . $conn->error;
        }
    }

    

    function getReaderInfo($reader_id) {
         global $conn;
        // Prepare SQL query to retrieve reader information
        $sql = "SELECT *
                FROM readers 
                WHERE reader_auto_id = ?";
    
        // Prepare statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind the reader_id to the query
            $stmt->bind_param("i", $reader_id);
    
            // Execute the query
            if ($stmt->execute()) {
                // Get the result set from the statement
                $result = $stmt->get_result();
    
                // Check if a reader was found
                if ($result->num_rows > 0) {
                    // Fetch the reader data as an associative array
                    $reader_info = $result->fetch_assoc();
                    // Return the reader information
                    return $reader_info;
                } else {
                    // No reader found, return NULL
                    return NULL;
                }
            } else {
                // If execution fails, return the error
                return "Error executing query: " . $stmt->error;
            }
    
            // Close the statement
            $stmt->close();
        } else {
            // If preparing the statement fails, return the error
            return "Error preparing the statement: " . $conn->error;
        }
    }
    
    
    

?>