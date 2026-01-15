CREATE DATABASE my_db;
USE my_db;
CREATE TABLE images(
    id INT AUTO_INCREMENT PRIMARY KEY,
    image_name VARCHAR(255),
    image_type VARCHAR(500),
    image_data LONGBLOB
    );
<?php
$conn = new mysqli("localhost", "root", "", "my_db");
if ($conn->connect_error) {
    die("Connection failed:" . $conn->connect_error);
}
if (isset($_GET['id'])) {
    ob_clean();
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT image_type,image_data FROM images WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($imageType, $imageData);
        $stmt->fetch();
        header("Content-Type: $imageType");
        echo $imageData;
        exit;
    } else {
        echo "image not found!";
        exit;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $imageName = $_FILES["image"]["name"];
        $imageType = $_FILES["image"]["type"];
        $imageData = file_get_contents($_FILES["image"]["tmp_name"]);
        $stmt = $conn->prepare("INSERT INTO images(image_name,image_type,image_data) VALUES(?,?,?)");
        $stmt->bind_param("sss", $imageName, $imageType, $imageData);
        $stmt->execute();
    }
}
function displayimages($conn)
{
    $result = $conn->query("SELECT id,image_name FROM images");
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div style='margin:15px;display:inline-block;'>
            <img src='?id=" . $row['id'] . "' alt='" . htmlspecialchars($row['image_name']) . "'
            width='200' height='200'
            style='border:1px solid #444;object-fit:cover;'>
            <br>" . htmlspecialchars($row['image_name']) . "
            </div>";
        }
    } else {
        echo "no images uploaded yet.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>upload & display images</title>
</head>
<body>
    <h1>Upload Image</h1>
    <form method="POST" enctype="multipart/form-data">
        <label>Select image:</label><br>
        <input type="file" name="image" required>
        <br><br>
        <input type="submit" value="upload">
    </form>
    <h2>Uploaded images</h2>
    <?php displayimages($conn); ?>
</body>
</html>