<?php
session_start();
include("connect.php");

$errorMessage = "";
$cancelMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cancel'])) {
        $cancelMessage = "Sign up cancelled.";
    } else {
        $firstName = $_POST["first_name"];
        $middleName = $_POST["middle_name"];
        $lastName = $_POST["last_name"];
        $username = $_POST["username"];
        $addressHouseBlkNo = $_POST["address_house_blk_no"];
        $addressStreet = $_POST["address_street"];
        $addressBarangay = $_POST["address_barangay"];
        $addressMunicipality = $_POST["address_municipality"];
        $addressCityProvince = $_POST["address_city_province"];
        $addressZipCode = $_POST["address_zip_code"];
        $birthday = $_POST["birthday"];
        $email = $_POST["email"];
        $contactNumber = $_POST["contact_number"];
        $password = $_POST["password"];
        $passwordRepeat = $_POST["repeat_password"];

        if (!empty($email) && !empty($username) && !empty($contactNumber) && !empty($password) && !is_numeric($email)) {
            // Check if email already exists
            $checkEmailQuery = "SELECT * FROM form WHERE email='$email'";
            $emailResult = mysqli_query($con, $checkEmailQuery);

            // Check if username already exists
            $checkUsernameQuery = "SELECT * FROM form WHERE Uname='$username'";
            $usernameResult = mysqli_query($con, $checkUsernameQuery);

            // Check if contact number already exists
            $checkContactQuery = "SELECT * FROM form WHERE contactnum='$contactNumber'";
            $contactResult = mysqli_query($con, $checkContactQuery);

            if ($emailResult && $usernameResult && $contactResult) {
                if (mysqli_num_rows($emailResult) > 0) {
                    $errorMessage = "Email already in use.";
                } elseif (mysqli_num_rows($usernameResult) > 0) {
                    $errorMessage = "Username already exists.";
                } elseif (mysqli_num_rows($contactResult) > 0) {
                    $errorMessage = "Contact number already in use.";
                } else {
                    // Hash the password
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    // Insert data into the database
                    $query = "INSERT INTO form (Fname, Mname, Lname, Uname, blcknum, street, brngy, municipality, city, zipcode, birthday, email, contactnum, pwrd) 
                              VALUES ('$firstName', '$middleName', '$lastName', '$username', '$addressHouseBlkNo', '$addressStreet', '$addressBarangay', 
                                      '$addressMunicipality', '$addressCityProvince', '$addressZipCode', '$birthday', '$email', '$contactNumber', '$hashedPassword')";

                    if (mysqli_query($con, $query)) {
                        $errorMessage = "Sign up complete.";
                    } else {
                        $errorMessage = "Error inserting data: " . mysqli_error($con);
                    }
                }
            } else {
                $errorMessage = "Error querying database: " . mysqli_error($con);
            }
        } else {
            $errorMessage = "Please fill in all required fields with valid information.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php if (!empty($cancelMessage)): ?>
            <div class="cancel-message" style="color: red; margin-bottom: 20px; text-align: center;">
                <?php echo $cancelMessage; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($errorMessage)): ?>
            <div class="error-message" style="color: red; margin-bottom: 20px; text-align: center;">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>

        <h2>Sign Up</h2>

        <form method="POST" action="">
            <!-- Full Name Information -->
            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <div style="display: flex; justify-content: space-between;">
                    <input type="text" name="first_name" id="first_name" placeholder="First Name" required style="flex: 1; margin-right: 5px;">
                    <input type="text" name="middle_name" id="middle_name" placeholder="Middle Name" style="flex: 1; margin-right: 5px;">
                    <input type="text" name="last_name" id="last_name" placeholder="Last Name" required style="flex: 1;">
                </div>
            </div>
            <div class="form-group">
                <label for="birthday">Birthday:</label>
                <input type="date" name="birthday" id="birthday" required>
            </div>

            <!-- Username and Contact Information -->
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" placeholder="Choose a username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="example@example.com" required>
            </div>
            <div class="form-group">
                <label for="contact_number">Contact Number:</label>
                <input type="text" name="contact_number" id="contact_number" placeholder="e.g. +639123456789" required>
            </div>

            <!-- Address Information -->
            <div class="form-group">
                <label for="address_house_blk_no">House/Block No.:</label>
                <input type="text" name="address_house_blk_no" id="address_house_blk_no" placeholder="House/Block No." required>
            </div>
            <div class="form-group">
                <label for="address_street">Street:</label>
                <input type="text" name="address_street" id="address_street" placeholder="Street Name" required>
            </div>
            <div class="form-group">
                <label for="address_barangay">Barangay:</label>
                <input type="text" name="address_barangay" id="address_barangay" placeholder="Barangay" required>
            </div>
            <div class="form-group">
                <label for="address_municipality">Municipality:</label>
                <input type="text" name="address_municipality" id="address_municipality" placeholder="Municipality" required>
            </div>
            <div class="form-group">
                <label for="address_city_province">City/Province:</label>
                <input type="text" name="address_city_province" id="address_city_province" placeholder="City/Province" required>
            </div>
            <div class="form-group">
                <label for="address_zip_code">Zip Code:</label>
                <input type="text" name="address_zip_code" id="address_zip_code" placeholder="Zip Code" required>
            </div>

            <!-- Password Information -->
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Create a password" required>
            </div>
            <div class="form-group">
                <label for="repeat_password">Repeat Password:</label>
                <input type="password" name="repeat_password" id="repeat_password" placeholder="Repeat your password" required>
            </div>

            <button type="submit" name="submit">Submit</button>
            <button type="submit" name="cancel">Cancel</button>
        </form>
        <p>Already registered? <a href="login.php">LOG IN HERE</a></p>
    </div>
</body>
</html>