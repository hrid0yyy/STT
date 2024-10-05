<?php

use thiagoalessio\TesseractOCR\TesseractOCR;

require 'vendor/autoload.php';

$fileRead = ''; // Initialize this variable to store the OCR result
$uploadedFilePath = ''; // Initialize this variable to store the uploaded image path

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $file_name = $_FILES['file']['name'];
        $tmp_file = $_FILES['file']['tmp_name'];

        if (!session_id()) {
            session_start();
            $unq = session_id();
        }

        $upload_dir = 'uploads/';
        $file_name = uniqid() . '_' . time() . '_' . str_replace(array('!', "@", '#', '$', '%', '^', '&', ' ', '*', '(', ')', ':', ';', ',', '?', '/' . '\\', '~', '`', '-'), '_', strtolower($file_name));

        if (move_uploaded_file($tmp_file, 'uploads/' . $file_name)) {
            $uploadedFilePath = 'uploads/' . $file_name; // Store the uploaded file path

            try {
                $fileRead = (new TesseractOCR($uploadedFilePath))
                    ->executable('C:/Program Files/Tesseract-OCR/tesseract.exe') // Full path to Tesseract
                    ->setLanguage('eng')
                    ->run();
            } catch (Exception $e) {
                 $e->getMessage();
            }
        } else {
            
        }
    }
}

function findMatchingBooks($ocrText) {
    // Establish the database connection (replace with your DB connection details)
    $db = new PDO("mysql:host=localhost;dbname=stt_db", 'root', '');

    // Break the OCR text into words or chunks
    // Split the OCR text by new lines and filter out empty lines
    $chunks = array_filter(preg_split('/\r\n|\r|\n/', $ocrText));

    // Prepare the base SQL query
    $sql = "SELECT * FROM books 
            JOIN authors ON books.author_id = authors.author_id 
            WHERE books.title LIKE :chunk 
            OR authors.name LIKE :chunk";

    $stmt = $db->prepare($sql);
    
    // Initialize an empty array to store the results
    $results = [];

    // Loop through each chunk to search in the database
    foreach ($chunks as $chunk) {
        $chunk = "%$chunk%"; // Use wildcards to match any part of the text
        $stmt->bindParam(':chunk', $chunk, PDO::PARAM_STR);
        $stmt->execute();

        // Fetch the results
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Add the results to the final result array if any book matches
        if ($books) {
            $results = array_merge($results, $books);
        }
    }

    // Return the results
    return $results;
}

?>

<style>
        .btn-success,
        .btn-success:hover {
            background-color: #62ab00;
            border-color: #62ab00;
        }



        .modal-header {
            background-color: #62ab00;
            color: white;
        }

        .modal-content {
            border-radius: 10px;
            border: none;
        }

        .form-group label {
            color: #333;
        }

        .modal-footer .btn-success {
            width: 100%;
        }
   
</style>



    <!-- Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Image Upload Form -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="filechoose">Choose File</label>
                            <input type="file" name="file" class="form-control-file" id="filechoose" required>
                            <button class="btn btn-success mt-3" type="submit" name="submit">Upload</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Modal -->
    <div class="modal fade" id="resultsModal" tabindex="-1" aria-labelledby="resultsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultsModalLabel">Results</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if ($_POST && $uploadedFilePath) : ?>
                        <h4>Uploaded Image:</h4>
                        <img src="<?= $uploadedFilePath ?>" width="200" height="200" alt="Uploaded Image" class="img-fluid" />
                        <hr>
                      
                        <h4>Matching Books:</h4>
                        <?php
                        // Example usage with the OCR text
                        $ocrText = $fileRead;
                        $matchedBooks = findMatchingBooks($ocrText);

                        // Output the results
                        if ($matchedBooks) {
                            foreach ($matchedBooks as $book) {
                                echo "Book Title: " . $book['title'] . "<br>";
                                echo "Author Name: " . $book['name'] . "<br><hr>";
                                break;
                            }
                        } else {
                            echo "No matching books found.";
                        }
                        ?>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

    <?php if ($_POST && $uploadedFilePath) : ?>
        <!-- Trigger results modal -->
        <script>
            var resultsModal = new bootstrap.Modal(document.getElementById('resultsModal'));
            resultsModal.show();
        </script>
    <?php endif; ?>




<!-- image search -->