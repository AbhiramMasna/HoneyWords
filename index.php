<?php
session_start();
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

    // Query the database to retrieve the user's password
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $real_password = $row["password"];

        // Generate honeywords
        $honeywords = array();
        for ($i = 0; $i < 5; $i++) {
            $honeywords[] = $real_password . rand(100, 999);
        }


        // Check if the entered password is a honeyword
        if (in_array($password, $honeywords)) {
            // Password is a honeyword, alert the admin
            $_SESSION['username'] = $username;
            header("Location: honeypot.php");
            exit();

            echo "<script>alert('Honeyword detected!');</script>";
        } else {
            // Password is not a honeyword, proceed with authentication
            if ($password === $real_password) {
                // Password is correct, login the user
                echo "<script>alert('Login successful!');</script>";
                $_SESSION['username'] = $username;
                header("Location: dashboard.php");
                exit();
            } else {
                // Password is incorrect, show error message
                echo "<script>alert('Honeyword detected');</script>";
                $_SESSION['username'] = $username;
                header("Location: honeypot.php");
                exit();
            }
        }
    } else {
        // User not found, show error message
        echo "<script>alert('');</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #333;
            font-size: 36px;
            text-align: center;
            margin-top: 50px;
        }

        form {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            font-size: 16px;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"] {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            border: none;
            color: #fff;
            padding: 12px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #3e8e41;
        }

        p {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h1>Login</h1>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username"><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password"><br><br>
        <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="registration.php">Register here</a></p>
</body>

</html>