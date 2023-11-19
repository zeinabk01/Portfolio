<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define the common upload directory
    $uploadDir =  "./gallery/";

    // Get user input
    $userName = isset($_POST["userName"]) ? $_POST["userName"] : '';

    // Check if the common gallery directory exists, create if not
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Check if an image was uploaded
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
        $tempName = $_FILES["image"]["tmp_name"];

        // Generate a unique filename based on timestamp
        $imageName = time();
        
        // Get the file extension of the uploaded image
        $imageExtension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

        // Create the image path with the same name and type in the gallery
        $imagePath = $uploadDir . $imageName . "." . $imageExtension;

        // Move the uploaded image to the specified directory
        if (move_uploaded_file($tempName, $imagePath)) {
            // Update the gallery.json file
            $galleryFile =  "gallery.json";
            $galleryData = [];

            // Load existing data from gallery.json
            if (file_exists($galleryFile)) {
                $galleryData = json_decode(file_get_contents($galleryFile), true);
            }

            // Add new image details
            $imageDetails = [
                "userName" => $userName,
                "imagePath" => $imagePath
            ];

            // Append new image details to the gallery data
            $galleryData[] = $imageDetails;

            // Save the updated gallery data to gallery.json
            file_put_contents($galleryFile, json_encode($galleryData, JSON_PRETTY_PRINT));

            echo "<p>Image uploaded successfully!</p>";

            header('Location: galleryDisplay.php');
        } else {
            echo "<p>Failed to move the uploaded file. Please check your server configuration.</p>";

            $_SESSION['error'] = 'Failed to move the uploaded file. Please check your server configuration.';
            header('Location: galleryDisplay.php');
        }
    } else {
        $_SESSION['error'] = 'Failed to upload image. Please make sure you selected a valid image file.';
        echo "<p>Failed to upload image. Please make sure you selected a valid image file.</p>";

        header('Location: galleryDisplay.php');
    }
}
?>
