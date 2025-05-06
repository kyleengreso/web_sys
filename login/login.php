<?php
session_start();

include('../includes/connection/db_conn.inc.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form values
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query the database for the user
    $sql = "SELECT id, email, password FROM user WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    // Check if the user exists
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Password is correct, store session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['email']; 

            // Log the login activity in the audit trail
            $activity = 'login';
            $log_sql = "INSERT INTO audit_trail (email, activity) VALUES ('$email', '$activity')";
            mysqli_query($conn, $log_sql);

            // Echo success message
            echo "<div class='alert alert-success' role='alert'>Login successful! Welcome, " . $row['email'] . "</div>";
        } else {
            // Incorrect password
            $error = "Invalid password. Please try again.";
        }
    } else {
        // User doesn't exist
        $error = "Invalid email address. Please try again.";
    }

    // Echo error message
    if (isset($error)) {
        echo "<div class='alert alert-danger' role='alert'>$error</div>";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motor Parts Shop - Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Login CSS -->
    <link href="../login/login.css" rel="stylesheet">
</head>
<body>

    <div class="container">
        <h2>Login</h2>
        <form action="../login/login.php" method="POST">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
        <p class="text-center mt-3">Don't have an account? <a href="register.php">Register here</a></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
