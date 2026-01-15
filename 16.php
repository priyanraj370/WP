<?php

$host = "localhost";
$username = "root"; 
$password = "";     
$dbname = "student_db";

$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        
        $id = $_POST['id'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $grade = $_POST['grade'];

        $stmt = $conn->prepare("INSERT INTO students(id, name, age, grade) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isis", $id, $name, $age, $grade);
        if ($stmt->execute()) {
            echo "<p>Student added successfully!</p>";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "<p>Error adding student: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }

    if (isset($_POST['update'])) {          
        $id = $_POST['id'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $grade = $_POST['grade'];

        $stmt = $conn->prepare("UPDATE students SET name=?, age=?, grade=? WHERE id=?");
        $stmt->bind_param("sisi", $name, $age, $grade, $id);
        if ($stmt->execute()) {
            echo "<p>Student updated successfully!</p>";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "<p>Error updating student: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }

    if (isset($_POST['delete'])) {
        
        $id = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM students WHERE id=?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "<p>Student deleted successfully!</p>";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "<p>Error deleting student: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }
}

$result = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Database</title>
</head>
<body>
    <h2>Student Database Management</h2>

    <form method="post" action="">
        <label for="id">id:</label><br>
        <input type="text" name="id" required placeholder="Student ID (for update/delete)" value="<?php echo isset($_POST['id']) ? htmlspecialchars($_POST['id']) : ''; ?>"><br><br>
        <label for="name">Name:</label><br>
        <input type="text" name="name" required value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>"><br><br>
        <label for="age">Age:</label><br>
        <input type="number" name="age" required value="<?php echo isset($_POST['age']) ? htmlspecialchars($_POST['age']) : ''; ?>"><br><br>
        <label for="grade">Grade:</label><br>
        <input type="text" name="grade" required value="<?php echo isset($_POST['grade']) ? htmlspecialchars($_POST['grade']) : ''; ?>"><br><br>
        <button type="submit" name="add">Add Student</button>
        <button type="submit" name="update">Update Student</button>
    </form>

    <form method="post" action="" style="margin-top: 20px;">
        <label for="id">Student ID to Delete:</label><br>
        <input type="number" name="id" required><br><br>
        <button type="submit" name="delete">Delete Student</button>
    </form>

    <h3>Student Records</h3>
    <?php if ($result->num_rows > 0): ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Grade</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><?php echo $row['grade']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No students found.</p>
    <?php endif; ?>
</body>
</html>

<?php
$conn->close();
?>


