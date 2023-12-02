<!-- dashboard.php -->
<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Photo Management</title>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>

        <!-- Add Photo Form -->
        <?php include("add_photo_form.php"); ?>

        <!-- Display Photos -->
        <?php include("display_photos.php"); ?>
    </div>
</body>
</html>
