<!-- register.php -->
<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = $_POST["new_username"];
    $newPassword = $_POST["new_password"];

    // Check if the username is already taken
    $checkUsername = "SELECT * FROM users WHERE username = '$newUsername'";
    $result = $conn->query($checkUsername);

    if ($result->num_rows > 0) {
        echo "Username already taken. Please choose a different one.";
    } else {
        // Insert new user into the database
        $insertUser = "INSERT INTO users (username, password) VALUES ('$newUsername', '$newPassword')";
        if ($conn->query($insertUser) === TRUE) {
            echo "Registration successful. You can now log in.";
        } else {
            echo "Error: " . $insertUser . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
