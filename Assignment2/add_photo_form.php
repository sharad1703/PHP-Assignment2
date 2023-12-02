<!-- add_photo_form.php -->
<form action="process_photo.php" method="post" enctype="multipart/form-data">
    <label for="photo">Choose a photo:</label>
    <input type="file" name="photo" accept="image/*" required>

    <button type="submit">Upload Photo</button>
</form>
