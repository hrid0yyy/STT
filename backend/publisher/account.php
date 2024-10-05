<?php
     include 'dbconnection.php';


     if (isset($_REQUEST['update_publisher_profile'])) {



        // Retrieve form data
        $publisher_id = $_SESSION['user_id'];
        $publisher_name = !empty($_POST['publisher_name']) ? $_POST['publisher_name'] : NULL;
        $address = !empty($_POST['address']) ? $_POST['address'] : NULL;
        $profile_pic = !empty($_POST['profile_pic']) ? $_POST['profile_pic'] : NULL;
        $phone_number = !empty($_POST['phone_number']) ? $_POST['phone_number'] : NULL;
        $established_date = !empty($_POST['established_date']) ? $_POST['established_date'] : NULL;
        $email = !empty($_POST['email']) ? $_POST['email'] : NULL;
        $website = !empty($_POST['website']) ? $_POST['website'] : NULL;
        echo $profile_pic;
        // Prepare SQL query
        $sql = "UPDATE publishers
                SET
                website = ?, 
                publisher_name = ?,
                address = ?,
                established_date = ?,
                   phone_number = ?,
                    email = ?,
                    profile_pic = ?
                WHERE publisher_id = ?";
    
        // Prepare statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters to the prepared statement
            $stmt->bind_param("sssssssi",$website, $publisher_name, $address, $established_date,$phone_number , $email, $profile_pic, $publisher_id);
            
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

    

    function getPublisherInfo($publisher_id) {
         global $conn;
        // Prepare SQL query to retrieve reader information
        $sql = "SELECT *
                FROM publishers 
                WHERE publisher_id = ?";
    
        // Prepare statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind the reader_id to the query
            $stmt->bind_param("i", $publisher_id);
    
            // Execute the query
            if ($stmt->execute()) {
                // Get the result set from the statement
                $result = $stmt->get_result();
    
                // Check if a reader was found
                if ($result->num_rows > 0) {
                    // Fetch the reader data as an associative array
                    $publishers_info = $result->fetch_assoc();
                    // Return the reader information
                    return $publishers_info;
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