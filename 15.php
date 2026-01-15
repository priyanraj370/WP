<!DOCTYPE html>
<html>
<head>
    <title>File Reader & Writer</title>
</head>
<body>
    
    <form action="15.php" method="post">
        <label for="textdata">Enter text:</label><br>
        <textarea name="textdata" id="textdata" rows="4" cols="50"></textarea><br>
        <input type="submit" value="Write to File"><br><br>
    </form>

    
    <form action="15.php" method="post" enctype="multipart/form-data">
        <label for="filedata">Upload file to read:</label><br>
        <input type="file" name="filedata" id="filedata"><br>
        <input type="submit" value="Read File Contents"><br><br>
    </form>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    if (!empty($_POST['textdata'])) {
        file_put_contents("Output3.txt", $_POST['textdata']);
        echo "Data written in file successfully.<br>";
    }

    
    if (isset($_FILES['filedata'])) {
        if (is_uploaded_file($_FILES['filedata']['tmp_name'])) {
            $filecontent = file_get_contents($_FILES['filedata']['tmp_name']);
            echo "<strong>File Content:</strong><br>";
            echo "<pre>" . htmlspecialchars($filecontent) . "</pre>";
        } else {
            echo "No file uploaded.<br>";
        }
    }
}
?>