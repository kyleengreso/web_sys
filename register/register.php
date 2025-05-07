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
    if (!preg_match("/^09\d{9}$/", $mobileNumber)) {
        $errorMessages[] = "Mobile number must start with 09 and be exactly 11 digits.";
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
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <h2>Create Account</h2>

            <?php if (!empty($errorMessages)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errorMessages as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form name="addUserForm" id="registrationForm" action="../register/register.php" method="POST">
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
                <button type="submit" class="btn btn-primary">Create Account</button>
            </form>
            <p class="text-center mt-3">Already have an account? <a href="../login/login.php">Login here</a></p>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        // Add immediate validation for mobile number
        $("#mobile_number").on('input', function() {
            $(this).valid();
        });

        $("#registrationForm").validate({
            rules: {
                first_name: {
                    required: true,
                    minlength: 2,
                    pattern: /^[A-Za-z\s]+$/
                },
                middle_name: {
                    pattern: /^[A-Za-z\s]*$/
                },
                last_name: {
                    required: true,
                    minlength: 2,
                    pattern: /^[A-Za-z\s]+$/
                },
                email: {
                    required: true,
                    email: true
                },
                mobile_number: {
                    required: true,
                    pattern: /^09\d{9}$/
                },
                password: {
                    required: true,
                    minlength: 8,
                    pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&_])[A-Za-z\d@$!%*#?&_]{8,}$/
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                first_name: {
                    required: "Please enter your first name",
                    minlength: "First name must be at least 2 characters long",
                    pattern: "First name can only contain letters and spaces"
                },
                middle_name: {
                    pattern: "Middle name can only contain letters and spaces"
                },
                last_name: {
                    required: "Please enter your last name",
                    minlength: "Last name must be at least 2 characters long",
                    pattern: "Last name can only contain letters and spaces"
                },
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address"
                },
                mobile_number: {
                    required: "Please enter your mobile number",
                    pattern: "Mobile number must start with 09 and be exactly 11 digits"
                },
                password: {
                    required: "Please enter a password",
                    minlength: "Password must be at least 8 characters long",
                    pattern: "Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character"
                },
                confirm_password: {
                    required: "Please confirm your password",
                    equalTo: "Passwords do not match"
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass('is-valid').removeClass('is-invalid');
            },
            // Enable immediate validation on keyup and blur
            onkeyup: function(element) {
                $(element).valid();
            },
            onfocusout: function(element) {
                $(element).valid();
            }
        });
    });
    </script>
</body>
</html>
