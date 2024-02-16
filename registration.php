<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "honeywords";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Generate honeywords
    $honeywords = array();
    for ($i = 0; $i < 5; $i++) {
        $honeywords[] = $password . rand(100, 999);
    }
    $honeywords_str = implode(',', $honeywords);

    // Insert user and honeywords into the database
    $sql = "INSERT INTO users (username, password, honeywords)
          VALUES ('$username', '$password', '$honeywords_str')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Registration successful!');</script>";
    } else {
        echo "<script>alert('Registration failed: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registration Page</title>
    <style>
        body {
            background-color: #F5F5F5;
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #FFF;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #CCC;
            box-sizing: border-box;
            margin-bottom: 20px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #FFF;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #3E8E41;
        }
    </style>
</head>

<body>
    <h1>Registration</h1>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username"><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password"><br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>
        <input type="submit" value="Register">

    </form>
</body>

</html>