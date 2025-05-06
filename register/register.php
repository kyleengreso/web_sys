<?php
include('../includes/connection/db_conn.inc.php');

// Declare variables for storing form data
$firstName = $middleName = $lastName = $email = $mobileNumber = $password = $confirmPassword = "";
$errorMessages = [];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect form data
    $firstName = trim($_POST['first_name']);
    $middleName = trim($_POST['middle_name']);
    $lastName = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $mobileNumber = trim($_POST['mobile_number']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);

    // Validate First Name
    if (strlen($firstName) < 2 || !preg_match("/^[A-Za-z\s]+$/", $firstName)) {
        $errorMessages[] = "First Name should be at least 2 characters and contain only letters and spaces.";
    }

    // Validate Middle Name (optional)
    if (!empty($middleName) && (strlen($middleName) < 2 || !preg_match("/^[A-Za-z\s]+$/", $middleName))) {
        $errorMessages[] = "Middle Name should be at least 2 characters and contain only letters and spaces.";
    }

    // Validate Last Name
    if (strlen($lastName) < 2 || !preg_match("/^[A-Za-z\s]+$/", $lastName)) {
        $errorMessages[] = "Last Name should be at least 2 characters and contain only letters and spaces.";
    }

    // Validate Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessages[] = "Please enter a valid email.";
    }

    // Validate Mobile Number (11 digits)
    if (!preg_match("/^0\d{10}$/", $mobileNumber)) {
        $errorMessages[] = "Mobile number must start with 0 and be exactly 11 digits.";
    }

    // Validate Password
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&_])[A-Za-z\d@$!%*#?&_]{8,}$/", $password)) {
        $errorMessages[] = "Password must be at least 8 characters, with 1 uppercase, 1 lowercase, 1 number, and 1 special character or underscore.";
    }

    // Validate Confirm Password
    if ($password !== $confirmPassword) {
        $errorMessages[] = "Passwords do not match.";
    }

    // If no validation errors, proceed with registration
    if (empty($errorMessages)) {
        // Hash the password for storage
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL query for inserting user into the database
        $sql = "INSERT INTO user (first_name, middle_name, last_name, email, mobile_number, password) 
                VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssss", $firstName, $middleName, $lastName, $email, $mobileNumber, $hashedPassword);

            // Execute the statement
            if ($stmt->execute()) {
                // Redirect to login page after successful registration
                header("Location: ../login/login.php");
                exit();
            } else {
                $errorMessages[] = "Error in registration, please try again.";
            }

            // Close the statement
            $stmt->close();
        } else {
            $errorMessages[] = "Error preparing SQL statement.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Motor Parts Shop</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../register/register.css" rel="stylesheet">
</head>
<body>

    <div class="container">
        <h2>Register</h2>

        <?php if (!empty($errorMessages)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errorMessages as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form name="addUserForm" action="../register/register.php" method="POST">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $firstName; ?>" required>
            </div>
            <div class="form-group">
                <label for="middle_name">Middle Name</label>
                <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo $middleName; ?>">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $lastName; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="form-group">
                <label for="mobile_number">Mobile Number</label>
                <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="<?php echo $mobileNumber; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>

</body>
</html>
