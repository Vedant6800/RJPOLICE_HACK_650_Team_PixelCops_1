<?php
require_once('conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve user inputs
    $admin_email = $_POST['admin_email'];
    $verificationCode = $_POST['verificationCode'];
    
    // Check if the station code and verification code match in the database
    $query = "SELECT * FROM admin WHERE email = '$admin_email' AND verification_code = '$verificationCode'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Check if matching records were found
        if (mysqli_num_rows($result) > 0) {
            // Matching station code and verification code found
            // Display input fields for the new password
            // require_once('adminheader.php');
           echo' <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ForgetPassword - Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body style="background-color: #222471">';

            

            echo '
            <body style="background-color: #222471">
                <div id="layoutAuthentication">
                    <div id="layoutAuthentication_content">
                        <main>
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-5">
                                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                                            <div class="card-header justify-content-center text-center d-flex"> <img class="mb-4" src="../assets/images/Rajasthan-Police-RAJ-Police.webp" alt="" height="50"></div>
                                            <div class="card-body">
                                                <form action="admin_password.php?vccode='.$verificationCode.'" method="post">
                                                    <div class="mb-3">
                                                        <label for="newPassword" class="form-label">New Password</label>
                                                        <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter New Password" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                                                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
                                                    </div>

                                                    <button type="submit" class="btn btn-success">Set New Password</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </body>';
        } else {
            // No matching records found
            echo '<p class="text-danger">Invalid Station Code or Verification Code. Please try again.</p>';
        }
    } else {
        // Query execution error
        echo '<p class="text-danger">Error executing query: ' . mysqli_error($conn) . '</p>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Forget Password - Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body style="background-color: #222471">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header justify-content-center text-center d-flex"> <img class="mb-4" src="../assets/images/Rajasthan-Police-RAJ-Police.webp" alt="" height="50"></div>
                                <div class="card-body">
                                    <form action="admin_forget_password.php" method="post">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="admin_email" placeholder="Enter your email" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="verificationCode" class="form-label">Verification Code</label>
                                            <input type="text" class="form-control" id="verificationCode" name="verificationCode" placeholder="Enter Verification Code" required>
                                        </div>

                                        <button type="submit" class="btn btn-success">Reset Password</button>
                                       

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>