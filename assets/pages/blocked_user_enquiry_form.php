<?php

$database = 'police_feedback_system';
$host = 'localhost';
$username = 'root';
$password = '';
$conn = new mysqli($host, $username, $password, $database);
    //  require_once('../php/config.php');
    global $user;

if(isset($_POST['submit_enquiry'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $enquiry = $_POST['query']; // Assuming 'query' is the name attribute of the textarea in the form

    // Find user_id based on username
    $query = "SELECT id FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $user_id);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($user_id) {
        // Perform database insertion
        $query = "INSERT INTO blocked_enquiry (user_id, email, enquiry) VALUES ( ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'iss', $user_id, $email, $enquiry);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // You can add additional checks or error handling here

        // Redirect or show a success message
        // header("Location: success_page.php");
        echo '<script> alert("enquiry successful");</script>';
        exit();
    } else {
        // Handle case when username is not found
        echo "Username not found.";
    }
}
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Blocked User Enquiry Form</title>
</head>
<body style="background-color: #f8f9fa;"> -->

<div class="container mt-5" style="background-color: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); margin-top: 50px;">
    <h2 class="text-center" style="color: #007bff;">Blocked User Enquiry Form</h2>
    <form action="blocked_user_enquiry_form.php" method="post">
        <div class="form-group">
            <label for="username" style="font-weight: bold;">Username:</label>
            <input type="text" class="form-control" id="username" name="username"  required>
           
        </div>

        <div class="form-group">
            <label for="email" style="font-weight: bold;">Email:</label>
            <input type="email" class="form-control" id="email" name="email"  required>
        </div>

        <div class="form-group">
            <label for="query" style="font-weight: bold;">Reason for Enquiry:</label>
            <textarea class="form-control" id="query" name="query" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-block" style="background-color: #007bff; border-color: #007bff;" onmouseover="this.style.backgroundColor='#0056b3'" onmouseout="this.style.backgroundColor='#007bff'" name="submit_enquiry">Submit Enquiry</button>
    </form>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html> -->
