<!DOCTYPE html>
<html>
<head>
    <title>Cookie Handling</title>
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST["username"];
    setcookie("username", $user_name, time() + (30 * 24 * 60 * 60)); 
    echo "<p>Cookie set! Reload the page to see the cookie value.</p>";
}

if (isset($_COOKIE["username"])) {
    echo "<p>Welcome back, " . htmlspecialchars($_COOKIE["username"]) . "!</p>";
} else {
    echo "<p>Welcome guest!</p>";
}
?>

<form method="post" action="">
    <label for="username">Enter your name:</label><br><br>
    <input type="text" name="username"><br><br>
    <input type="submit" value="Set Cookie">
</form>

</body>
</html>