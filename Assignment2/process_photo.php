<?php
include("db.php");

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$userID = $_SESSION['user_id'];

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle image upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the image file is an actual image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["photo"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            // Insert the file path into the database
            $photoPath = $targetFile;
            $insertPhoto = "INSERT INTO photos (user_id, photo_path) VALUES ('$userID', '$photoPath')";
            
            if ($conn->query($insertPhoto) === TRUE) {
                echo "The file " . htmlspecialchars(basename($_FILES["photo"]["name"])) . " has been uploaded.";
            } else {
                echo "Error: " . $insertPhoto . "<br>" . $conn->error;
            }
            
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        if (file_exists($targetFile)) {
            echo "File successfully moved to: " . $targetFile;
        } else {
            echo "File move failed. Destination path: " . $targetFile;
        }
        
    }
}

$conn->close();
header("Location: dashboard.php"); // Redirect back to the dashboard
?>

