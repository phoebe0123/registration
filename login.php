<?php
session_start(); // Start the session to store user info after login

$host = 'localhost';
$username = 'root';
$password = '';  
$database = 'register';

$con = mysqli_connect($host, $username, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$error_message = '';  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Uname']) && isset($_POST['password'])) {
        $Uname = $_POST['Uname'];
        $password = $_POST['password'];

        // First, check if the username exists
        $query = "SELECT * FROM form WHERE Uname='$Uname'";
        $result = mysqli_query($con, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                // Username exists, check the password
                if (password_verify($password, $row['pwrd'])) {
                    // Password matches
                    // Store the username in the session
                    $_SESSION['username'] = $Uname; // Store the username in the session

                    // Redirect to the homepage
                    header("Location: homepage.php");
                    exit();
                } else {
                    // Password does not match
                    $error_message = "Incorrect password. Please try again.";
                }
            } else {
                // Username does not exist
                $error_message = "Username doesn't exist.";
            }
        } else {
            $error_message = "Error: " . mysqli_error($con);
        }
    } else {
        $error_message = "Please enter both username and password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>

        <?php if (!empty($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="Uname">Username:</label>
                <input type="text" name="Uname" id="Uname" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit" name="login">Login</button>
            <button type="button" onclick="window.location.href='registration.php'">Cancel</button>
        </form>

        <p>Haven't signed up yet? <a href="registration.php">SIGN UP HERE</a></p>
    </div>
</body>
</html>
