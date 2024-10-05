<?php 

session_start();

include 'dbconnection.php';

include 'readers.php';

function authenticate_user($input_email, $input_password) {
    global $conn;

    

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {

        $stmt->bind_param("s", $input_email);
        $stmt->execute();
  
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {

            $user = $result->fetch_assoc();
         
            if (password_verify($input_password, $user['password_hash'])) {

                $_SESSION['email'] = $input_email;
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_type'] = $user['user_type'];
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['password'] = $user['password_hash'];


                

              
                return true; 
            } else {
           ?>
               <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Holy!</strong> Wrong Password!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
           <?php
        
                return false; 
            }
        } else {
           ?>
             <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Holy!</strong> There is no such user!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php

            return false; 
        }
    } else {
        die("Database query failed: " . $conn->error);
    }
}


   
  



function signup_user($username, $email, $password, $user_type) {
    global $conn;

    // Password validation: at least 8 characters, one lowercase, one uppercase
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $password)) {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Error!</strong> Password must contain at least 8 characters, including one lowercase and one uppercase letter.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
              </div>";
        return false;
    }

    // Check if the username or email already exists
    $check_sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($check_sql);
    if ($stmt) {
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>Holy!</strong> A user with this username or email already exists!
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                  </div>";
            return false;
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user into the database
            $insert_sql = "INSERT INTO users (username, email, password_hash, user_type) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_sql);
            if ($stmt) {
                $stmt->bind_param("ssss", $username, $email, $hashed_password, $user_type);

                if ($stmt->execute()) {
                    // Get the inserted user ID
                    $user_id = $conn->insert_id;

                    // Store user data in session
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                    $_SESSION['user_type'] = $user_type;

                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>Success!</strong> You have signed up successfully.
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                          </div>";

                    return true;
                } else {
                    echo "Signup failed: " . $stmt->error;
                    return false;
                }
            } else {
                echo "Database query failed: " . $conn->error;
                return false;
            }
        }
    } else {
        echo "Database query failed: " . $conn->error;
        return false;
    }
}


?>
