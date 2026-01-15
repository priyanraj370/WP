<!DOCTYPE html>
<html>
<head>
<title>Form Validation</title>
</head>
<body>
<form method = "post" action = "">
Name: <input type = "text" name = "name"><br><br>
Email: <input type = "text" name = "email"><br><br>
<input type = "submit" name = "submit" value = "submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    if (empty($name))
    {
        echo "Name is required.<br>";
    }
    else
    {
        echo "Name : " . $name . "<br>";
    }

    if (empty($email))
    {
        echo "Email is required.<br>";
    }
    else
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            echo "Invalid email format.<br>";
        }
        else
        {
            echo "Email : " . $email . "<br>";
        }
    }
}
?>
</body>
</html>