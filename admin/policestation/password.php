<?php
require_once('../conn.php');
//require_once('adminheader.php');

echo' <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ForgetPassword - PoliceStation</title>
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body style="background-color: #222471">';
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Retrieve new password and confirm password from the form
                $newPassword = $_POST['newPassword'];
                $confirmPassword = $_POST['confirmPassword'];   
                $stationCode = $_GET['stcode'];

                // Check if new password and confirm password match
                if ($newPassword == $confirmPassword) {
                    // Update the password in the database
                    //$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $updateQuery = "UPDATE police_station SET password = '$newPassword' WHERE station_code = '$stationCode'";
                    $updateResult = mysqli_query($conn, $updateQuery);

                    if ($updateResult) {
                        // echo '<p class="text-success">Password updated successfully.</p>';
                        header("Location: ps_login.php");
                    } else {
                        echo '<p class="text-danger">Error updating password: ' . mysqli_error($conn) . '</p>';
                    }
                } 
                else {
                    echo '<p class="text-danger">New Password and Confirm Password do not match. Please try again.</p>';
                }
            }




?>
