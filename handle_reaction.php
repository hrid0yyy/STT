<?php
session_start();
$db = new PDO("mysql:host=localhost;dbname=stt_db", 'root', '');

// Fetch POST data
$data = json_decode(file_get_contents('php://input'), true);
$review_id = $data['review_id'];
$reaction = $data['reaction'];
$reader_id = $_SESSION['user_id'];  // Assuming the user is logged in and their ID is in the session

// Check if the user has already reacted
$query = "
    SELECT Reaction FROM ReviewReactions
    WHERE ReviewID = :review_id AND ReaderID = :reader_id
";
$stmt = $db->prepare($query);
$stmt->bindParam(':review_id', $review_id);
$stmt->bindParam(':reader_id', $reader_id);
$stmt->execute();
$existingReaction = $stmt->fetch(PDO::FETCH_ASSOC);

if ($existingReaction) {
    // User has already reacted
    if ($existingReaction['Reaction'] === $reaction) {
        // If the same reaction is being submitted, delete the reaction
        $deleteQuery = "
            DELETE FROM ReviewReactions
            WHERE ReviewID = :review_id AND ReaderID = :reader_id
        ";
        $deleteStmt = $db->prepare($deleteQuery);
        $deleteStmt->bindParam(':review_id', $review_id);
        $deleteStmt->bindParam(':reader_id', $reader_id);
        $deleteStmt->execute();

        echo json_encode(['status' => 'success', 'message' => 'Reaction removed.']);
    } else {
        // If the user wants to change their reaction, prompt them
        if (isset($data['change']) && $data['change'] === true) {
            // Update the reaction
            $updateQuery = "
                UPDATE ReviewReactions
                SET Reaction = :reaction
                WHERE ReviewID = :review_id AND ReaderID = :reader_id
            ";
            $updateStmt = $db->prepare($updateQuery);
            $updateStmt->bindParam(':reaction', $reaction);
            $updateStmt->bindParam(':review_id', $review_id);
            $updateStmt->bindParam(':reader_id', $reader_id);
            $updateStmt->execute();

            echo json_encode(['status' => 'success', 'message' => 'Reaction updated successfully.']);
        } else {
            // Prompt the user to confirm if they want to change their reaction
            echo json_encode(['status' => 'prompt', 'message' => 'You have already reacted to this review. Do you want to change your reaction?']);
        }
    }
} else {
    // User has not reacted yet, insert a new reaction
    $insertQuery = "
        INSERT INTO ReviewReactions (ReviewID, ReaderID, Reaction)
        VALUES (:review_id, :reader_id, :reaction)
    ";
    $insertStmt = $db->prepare($insertQuery);
    $insertStmt->bindParam(':review_id', $review_id);
    $insertStmt->bindParam(':reader_id', $reader_id);
    $insertStmt->bindParam(':reaction', $reaction);

    if ($insertStmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Reaction recorded successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to record reaction. Please try again.']);
    }
}
?>
