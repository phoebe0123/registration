<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

$memberInfo = isset($_GET['member']) ? $_GET['member'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f9f0f6;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
        }

        h2 {
            color: #d5006d;
            text-align: center;
            margin-bottom: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            background: #ffeef8;
        }

        a {
            text-decoration: none;
            color: #d5006d;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .member-info {
            padding: 10px;
            margin-top: 5px;
            background-color: #fef1f7;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        li a {
            cursor: pointer;
        }

        .logout-form {
            margin-top: 20px;
            text-align: center;
        }

        .image-container {
            display: inline-block; /* Adjusts to the size of the image */
            padding: 20px;         /* Small space around the image */
            background-color: #f8e1e8; /* Pink background */
            border-radius: 20px;   /* Rounded corners */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Optional shadow */
            margin: 20px auto;     /* Centers the container and adds space around */
        }

        .customizable-image {
            width: 350px;  /* Set fixed width of the image */
            height: 250px; /* Set fixed height of the image */
            object-fit: cover; /* Ensures the image maintains aspect ratio while filling the area */
            border-radius: 15px; /* Optional rounded corners for the image */
        }

    </style>
</head>
<body>
    <div class="container">
    <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
    <p>This is your home page. Here you can find information about group members and activities.</p>
    <div class="image-container">
    <img src="462555016_610716011288229_8946873936995447443_n.jpg" alt="Welcome Image" class="customizable-image">
    </div>
        <h3>Group Members</h3>
        <ul>
            <li>
                <a href="?member=1">ADDUCOL, PAUL SEBESTIEN SA.</a>
                <?php if ($memberInfo == '1'): ?>
                    <div class="member-info">
                        <p><strong>Full Name:</strong> Paul Sebastien Sa. Adducol</p>
                        <p><strong>Username:</strong> Paul</p>
                        <p><strong>Address:</strong> ewan</p>
                        <p><strong>Email:</strong> paul@gmail.com</p>
                    </div>
                <?php endif; ?>
            </li>
            <li>
                <a href="?member=2">ANNONICAL, KURTH JUSTINE</a>
                <?php if ($memberInfo == '2'): ?>
                    <div class="member-info">
                        <p><strong>Full Name:</strong> Kurth Justine Annonical</p>
                        <p><strong>Username:</strong> Kurth</p>
                        <p><strong>Address:</strong> ewan</p>
                        <p><strong>Email:</strong> kurth@gmail.com</p>
                    </div>
                <?php endif; ?>
            </li>
            <li>
                <a href="?member=3">BANDAY, LANCE LORRENCE V.</a>
                <?php if ($memberInfo == '3'): ?>
                    <div class="member-info">
                        <p><strong>Full Name:</strong> Lance Lorrenve V. Banday</p>
                        <p><strong>Username:</strong> Lance</p>
                        <p><strong>Address:</strong> ewan</p>
                        <p><strong>Email:</strong> lance@gmail.com</p>
                    </div>
                <?php endif; ?>
            </li>
            <li>
                <a href="?member=4">MAYCACAYAN, JHON EFREN ISAAC A.</a>
                <?php if ($memberInfo == '4'): ?>
                    <div class="member-info">
                        <p><strong>Full Name:</strong> Jhon Efren Isaac A. Maycacayan</p>
                        <p><strong>Username:</strong> Jhon</p>
                        <p><strong>Address:</strong> ewan</p>
                        <p><strong>Email:</strong> jhon@gmail.com</p>
                    </div>
                <?php endif; ?>
            </li>
            <li>
                <a href="?member=5">RINO, ROMME CHARLES G.</a>
                <?php if ($memberInfo == '5'): ?>
                    <div class="member-info">
                        <p><strong>Full Name:</strong> Romme Charles G. Rino</p>
                        <p><strong>Username:</strong> Romme</p>
                        <p><strong>Address:</strong> ewan</p>
                        <p><strong>Email:</strong> romme@gmail.com</p>
                    </div>
                <?php endif; ?>
            </li>
            <li>
                <a href="?member=6">SAITO, HIROTAKA C.</a>
                <?php if ($memberInfo == '6'): ?>
                    <div class="member-info">
                        <p><strong>Full Name:</strong> Hirotaka C. Saito</p>
                        <p><strong>Username:</strong> Hiro</p>
                        <p><strong>Address:</strong> ewan</p>
                        <p><strong>Email:</strong> hiro@gmail.com</p>
                    </div>
                <?php endif; ?>
            </li>
            <li>
                <a href="?member=7">SISTINA, BEA AVEGAIL G.</a>
                <?php if ($memberInfo == '7'): ?>
                    <div class="member-info">
                        <p><strong>Full Name:</strong> Bea Avegail G. Sistina</p>
                        <p><strong>Username:</strong> Bea</p>
                        <p><strong>Address:</strong> ....</p>
                        <p><strong>Email Address:</strong> bea@gmail.com</p>
                    </div>
                <?php endif; ?>
            </li>
        </ul>

        <div class="logout-form">
            <form method="POST" action="logout.php">
                <button type="submit" name="logout">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>
